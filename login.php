<?php
// login.php

session_start();
// 1) If already logged in, send them back to the main page
if (!empty($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// 2) Load your DB connection and user lookup
require_once 'models/database.php';
require_once 'models/user_db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 3) Grab & sanitize inputs
    $email    = trim($_POST['email']    ?? '');
    $password = trim($_POST['password'] ?? '');

    // 4) Look up user (must SELECT role in your model!)
    $user = get_user_by_email($email);

    // 5) Verify credentials
    if ($user && password_verify($password, $user['password'])) {
        // 6) Stash everything in the session
        $_SESSION['user_id']    = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['role']       = $user['role'];    // ← new!

        header('Location: index.php');
        exit();
    } else {
        $error = 'Invalid email or password.';
    }
}

// 7) Show the login form
include 'views/header.php';
?>
<main>
  <h1>Login</h1>
  <?php if ($error): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>
  <form method="post">
    <label>
      Email:
      <input type="email" name="email" required>
    </label><br>
    <label>
      Password:
      <input type="password" name="password" required>
    </label><br>
    <button type="submit">Log In</button>
  </form>
</main>
<?php include 'views/footer.php'; ?>
