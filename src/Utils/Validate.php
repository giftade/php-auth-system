<?php

class Validate
{
  public function isEmpty(array $fields): bool
  {
    foreach ($fields as $field) {
      if (trim($field) === "") {
        return true;
      }
    }
    return false;
  }

  public function isEmailValid(string $email): bool
  {
    return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
  }

  public function isPasswordStrong(string $password): bool{
return strlen($password) >= 8;
  }

  public function doPasswordsMatch(string $password, string $confirmPassword): bool {
   return trim($password) === trim($confirmPassword);
  }
}


