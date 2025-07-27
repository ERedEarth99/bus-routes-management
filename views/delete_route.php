<?php
// Make sure admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

// Get route_id from GET or POST
$route_id = $_GET['id'] ?? $_POST['route_id'] ?? null;
if (!$route_id) {
    echo "<p>No route specified.</p>";
    exit();
}
?>

<h2>Confirm Delete</h2>
<p>Are you sure you want to delete route #<?= htmlspecialchars($route_id) ?>?</p>
<form action="controllers/route_controller.php" method="post">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="route_id" value="<?= htmlspecialchars($route_id) ?>">
    <button type="submit">Delete</button>
    <a href="index.php">Cancel</a>
</form>
