<?php
require_once __DIR__ . '/../includes/autoload.php';

$auth = new Auth();
$token = $_GET['token'] ?? '';

if ($token) {
  if ($auth->verifyEmailToken($token)) {
    echo "Email verified successfully! You can now <a href='../public/login.php'>login</a>.";
  } else {
    echo "Invalid or expired token.";
  }
} else {
  echo "No verification token provided.";
}
