<?php
require_once __DIR__ . '/../includes/autoload.php';

$auth = new Auth();
$validate = new Validate();

$errors = [];
$successMessage = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = htmlspecialchars(trim($_POST['email'] ?? ''));
  $password = $_POST['password'] ?? '';

  if ($validate->isEmpty([$email, $password])) {
    $errors[] = "All fields are required";
  }

  if (!$validate->isEmailValid($email)) {
    $errors[] = "Invalid email address";
  }

  if (empty($errors)) {
    $result = $auth->login($email, $password);

    if ($result === "success") {
      header("Location: dashboard.php");
      exit;
    } elseif ($result === "wrong_password") {
      $errors[] = "Incorrect password.";
    } elseif ($result === "not_verified") {
      $errors[] = "Please verify your email before logging in.";
    } else {
      $errors[] = "User not found.";
    }
  }
}
?>
<?php include '../includes/header.php'; ?>

<body class="login-page">
  <div class="container form">
    <h2 class="login-page">Login</h2>

    <?php foreach ($errors as $error): ?>
      <div class="message error"><?= $error ?></div>
    <?php endforeach; ?>

    <?php if (!empty($successMessage)): ?>
      <div class="message success"><?= $successMessage ?></div>
    <?php endif; ?>

    <form method="POST">
      <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($email) ?>" required>
      <input type="password" name="password" placeholder="Password" required>
      <button class="login-page" type="submit">Login</button>
    </form>

    <p class="login-page">Don't have an account? <a class="login-page" href="register.php">Register</a></p>
  </div>
  <?php include '../includes/footer.php'; ?>