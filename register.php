<?php
session_start();
require_once 'models/database.php';
require_once 'models/user_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email   = $_POST['email']   ?? '';
    $password= $_POST['password']?? '';
    $confirm = $_POST['confirm'] ?? '';

    if (empty($email) || empty($password) || empty($confirm)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email.";
    } elseif ($password !== $confirm) {
        $error = "Passwords must match.";
    } elseif (get_user_by_email($email)) {
        $error = "Email already registered.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        create_user($email, $hash);
        header('Location: login.php');
        exit();
    }
}
?>
<?php include 'views/header.php'; ?>
<main>
  <h1>Register</h1>
  <?php if (!empty($error)): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
  <form method="post">
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <label>Confirm: <input type="password" name="confirm" required></label><br>
    <button type="submit">Register</button>
  </form>
</main>
<p>Already have an account? <a href="login.php">Log in here</a></p>
<?php include 'views/footer.php'; ?>