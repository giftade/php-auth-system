<?php
class Auth extends User
{
  public function register(string $username, string  $email, string $password): bool
  {
    $user = $this->getUserByEmail($email);

    if (!$user) {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $verificationToken = bin2hex(random_bytes(32));

      $created = $this->createUser($username, $email, $hashedPassword, $verificationToken);
      if ($created) {
       return $this->sendVerificationEmail($email, $verificationToken);
      }
        return false;
    } else {
      return false;
    }
  }

  public function login(string $email, string $password): string
  {
    // Fetch the user by email
    $user = $this->getUserByEmail($email);
    if ($user) {
      if(!$user['is_verified']) {
        return 'not_verified';
      }
      // Check if password matches
      if (password_verify($password, $user['password'])) {
        // Password is correct, start session     
        session_start();
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];

        return "success"; //Login successful
      } else {
        // Invalid Password
        return "wrong_password";
      }
    }
    // User not found
    return "user_not_found";
  }

  public function logout()
  {
    session_start();
    session_unset();
    session_destroy();
  }

  public function sendVerificationEmail(string $email, string $token): bool
  {
    $verificationUrl = "http://localhost:8080/includes/verify.php?token=" . urlencode($token);

    $subject = "Verify your email address";
    $message = "Hi,\n\nPlease click the link below to verify your email address:\n$verificationUrl\n\nThank you!";
    $headers = "From: no-reply@gsa.com\r\n";

    // Simple mail() function, configure your SMTP for production
    if (mail($email, $subject, $message, $headers)) {
      return true;
    } else {
      return false;
    }
  }

  public function verifyEmailToken(string $token): bool {
    $user = $this->getUserByVerificationToken($token);
    if ($user) {
      // Mark user as verified and clear the token
      return $this->markUserAsVerified($user['id']);
    }
    return false;
  }
}
