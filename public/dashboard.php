<?php
require_once '../includes/functions.php';

// Redirect if not logged in
if (!isLoggedIn()) {
  header("Location: login.php");
  exit;
}

$username = $_SESSION['username'] ?? 'User';

?>
<?php include '../includes/header.php'; ?>


<body class="dashboard">
  <div class="container dashboard">
    <h2 class="dashboard">Welcome, <?= htmlspecialchars($username) ?>!</h2>

    <p>You are now logged in.</p>

    <form action="logout.php" method="post">
      <button class="dashboard" type="submit">Logout</button>
    </form>
  </div>
</body>

<?php include '../includes/footer.php'; ?>