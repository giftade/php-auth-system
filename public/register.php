<?php
require_once __DIR__ . '/../includes/autoload.php';

$auth = new Auth();
$validate = new Validate();

$errors = [];
$successMessage = '';
$email = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = htmlspecialchars(trim($_POST['username'] ?? ''));
  $email = htmlspecialchars(trim($_POST['email'] ?? ''));
  $password = $_POST['password'] ?? '';
  $confirmPassword = $_POST['confirm_password'] ?? '';

  if ($validate->isEmpty([$username, $email, $password, $confirmPassword])) {
    $errors[] = "All fields are required";
  }

  if (!$validate->isEmailValid($email)) {
    $errors[] = "Invalid email address";
  }

  if (!$validate->isPasswordStrong($password)) {
    $errors[] = "Password must be at least 8 characters";
  }

  if (!$validate->doPasswordsMatch($password, $confirmPassword)) {
    $errors[] = "Passwords do not match";
  }

  if (empty($errors)) {
    $registerSuccess = $auth->register($username, $email, $password);
    if ($registerSuccess === true) {
      $successMessage = "User registered successfully!";
      // header("refresh:3;url=login.php");
    }
    else {
      $errors[] = "Failed to register user. Possibly the email or username is already taken.";
    }
  }
}
?>

<?php include '../includes/header.php'; ?>

<body>
  <div class="container form">
    <h2>Register</h2>

    <?php foreach ($errors as $error): ?>
      <div class="message error"><?= $error ?></div>
    <?php endforeach; ?>

    <?php if (!empty($successMessage)): ?>
      <div class="message success"><?= $successMessage ?></div>
    <?php endif; ?>

    <form method="POST">
      <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($username) ?>" required>
      <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($email) ?>" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login</a></p>
  </div>

  <?php include '../includes/footer.php'; ?>