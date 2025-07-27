<?php
// views/edit_route_form.php
include 'views/header.php';

if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

if (!isset($route)) {
    echo "<p>Route not found.</p>";
    include 'views/footer.php';
    exit();
}
?>
<main>
    <h1>Edit Route</h1>
    <form action="controllers/update_route.php" method="post">
        <input type="hidden" name="route_id" value="<?= htmlspecialchars($route['route_id']) ?>">

        <label>Route Name:<br>
            <input type="text" name="route_name" value="<?= htmlspecialchars($route['route_name']) ?>" required>
        </label><br><br>

        <label>Stops (comma-separated):<br>
            <input type="text" name="stops" value="<?= htmlspecialchars($route['stops']) ?>" required>
        </label><br><br>

        <label>Start Time:<br>
            <input type="time" name="start_time" value="<?= htmlspecialchars($route['start_time']) ?>" step="1" required>
        </label><br><br>

        <label>End Time:<br>
            <input type="time" name="end_time" value="<?= htmlspecialchars($route['end_time']) ?>" step="1" required>
        </label><br><br>

        <button type="submit">Update Route</button>
        <a href="admin_routes.php">Cancel</a>
    </form>
</main>
<?php include 'views/footer.php'; ?>
