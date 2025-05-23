<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  session_unset();
  session_destroy();

  header("Location: login.php");
  exit;
} else {
  header("Location: dashboard.php");
  exit;
}
