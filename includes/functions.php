<?php 

function isLoggedIn(): bool {
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  if (isset($_SESSION['user_id'])) {
    return true;
  }

  return false;
}