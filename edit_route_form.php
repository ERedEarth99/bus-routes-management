<?php
// edit_route_form.php
session_start();

// Only admins allowed
if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

// Load model
require_once 'models/database.php';
require_once 'models/route_db.php';

// Get route ID from URL
$route_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$route_id) {
    header('Location: admin_routes.php');
    exit();
}

// Fetch the route
$route = get_route($route_id);
if (!$route) {
    header('Location: admin_routes.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['route_name'] ?? '');
    $stops = trim($_POST['stops'] ?? '');
    $start_time = trim($_POST['start_time'] ?? '');
    $end_time = trim($_POST['end_time'] ?? '');
    
    $errors = [];
    
    // Basic validation
    if (empty($name)) $errors[] = "Route name is required.";
    if (empty($stops)) $errors[] = "Stops are required.";
    if (empty($start_time)) $errors[] = "Start time is required.";
    if (empty($end_time)) $errors[] = "End time is required.";
    
    if (empty($errors)) {
        update_route($route_id, $name, $stops, $start_time, $end_time);
        header('Location: admin_routes.php');
        exit();
    }
}

include 'views/header.php';
?>

<main>
    <h1>Edit Route</h1>
    
    <?php if (!empty($errors)): ?>
        <div class="error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <form action="edit_route_form.php?id=<?= $route_id ?>" method="post">
        <fieldset>
            <legend>Route Information</legend>
            
            <label for="route_name">Route Name:</label>
            <input type="text" id="route_name" name="route_name" 
                   value="<?= htmlspecialchars($route['route_name']) ?>" required>
            
            <label for="stops">Stops:</label>
            <textarea id="stops" name="stops" rows="4" required><?= htmlspecialchars($route['stops']) ?></textarea>
            
            <label for="start_time">Start Time:</label>
            <input type="time" id="start_time" name="start_time" 
                   value="<?= htmlspecialchars($route['start_time']) ?>" required>
            
            <label for="end_time">End Time:</label>
            <input type="time" id="end_time" name="end_time" 
                   value="<?= htmlspecialchars($route['end_time']) ?>" required>
        </fieldset>
        
        <div class="form-buttons">
            <button type="submit">Update Route</button>
            <a href="admin_routes.php">Cancel</a>
        </div>
    </form>
</main>

<?php include 'views/footer.php'; ?>