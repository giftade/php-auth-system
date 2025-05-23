<?php
class User extends Dbh
{
  public function createUser(string $username, string $email, string $hashedPassword, string $verificationToken): bool
  {
    try {
      $stmt = $this->connect()->prepare("
          INSERT INTO users (username, email, password, verification_token)
          VALUES (:username, :email, :password, :token)
        ");
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':password', $hashedPassword);
      $stmt->bindParam(':token', $verificationToken);

      return $stmt->execute();
    } catch (PDOException $e) {    
      return false;
    }
  }

  public function getUserByEmail(string $email): array|false
  {
    try {
      $stmt = $this->connect()->prepare("
      SELECT * FROM users WHERE email = :email
    ");
      $stmt->bindParam(':email', $email);
      $stmt->execute();

      return $stmt->fetch() ?: false;
    } catch (PDOException $e) {
      return false;
    }
  }

  public function getUserByID(int $id): array|false {
    try {
      $stmt = $this->connect()->prepare("
        SELECT id,username,email,password FROM users WHERE id = :id
      ");

      $stmt->bindParam(':id', $id);
      $stmt->execute();

      return $stmt->fetch() ?: false;
    }catch(PDOException $e) {
      return false;
    }
  }

public function getUserByVerificationToken(string $token): array|false {
  try {
    $stmt = $this->connect()->prepare("
    SELECT * FROM users WHERE verification_token = :token AND is_verified = 0");
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    return $stmt->fetch() ?: false;
  }catch(PDOException $e) {
    return false;
  }
}

public function markUserAsVerified(int $userId): bool {
try {
  $stmt = $this->connect()->prepare(
    "UPDATE users SET is_verified = 1, verification_token = NULL
    WHERE id =:id
  ");
  $stmt->bindParam(':id', $userId);
  return $stmt->execute();
} catch (PDOException $e) {
  return false;
}
}
}
