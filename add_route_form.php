<?php
// add_route_form.php
include 'views/header.php';
if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}
?>
<main>
  <h1>Add New Route</h1>
  <form action="add_route.php" method="post">
    <label>Route Name:</label><br>
    <input type="text" name="route_name" required><br><br>

    <label>Stops (comma-separated):</label><br>
    <input type="text" name="stops" required><br><br>

    <label>Start Time (HH:MM:SS):</label><br>
    <input type="time" name="start_time" step="1" required><br><br>

    <label>End Time (HH:MM:SS):</label><br>
    <input type="time" name="end_time" step="1" required><br><br>

    <button type="submit">Create Route</button>
    <a href="admin_routes.php">Cancel</a>
  </form>
</main>
