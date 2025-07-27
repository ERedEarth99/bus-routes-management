<?php
// Only show this page if admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit();
}
$admin = $_SESSION['admin'];
?>

<h2>Welcome, <?= htmlspecialchars($admin['email']) ?> (Admin)</h2>
<a href="logout.php">Logout</a>
<!-- You can put more admin features here if needed -->
<h3>Admin Dashboard</h3>
<p>Here you can manage bus routes, users, and other admin tasks.</p>