<?php
// controllers/update_route.php
session_start();

// 1. Only admins may update routes
if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

// 2. Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../admin_routes.php');
    exit();
}

// 3. Load DB logic
require_once '../models/database.php';
require_once '../models/route_db.php';

// 4. Sanitize & validate input
$route_id   = filter_input(INPUT_POST, 'route_id', FILTER_VALIDATE_INT);
$route_name = trim($_POST['route_name'] ?? '');
$stops      = trim($_POST['stops'] ?? '');
$start_time = trim($_POST['start_time'] ?? '');
$end_time   = trim($_POST['end_time'] ?? '');

$errors = [];

if (!$route_id) {
    $errors[] = 'Invalid route ID.';
}
if ($route_name === '') {
    $errors[] = 'Route name is required.';
}
if ($stops === '') {
    $errors[] = 'Stops are required.';
}
if (strlen($start_time) < 5) {
    $errors[] = 'Start time is invalid.';
}
if (strlen($end_time) < 5) {
    $errors[] = 'End time is invalid.';
}

// 5. If errors, reload edit form with current values
if (!empty($errors)) {
    $route = [
        'route_id'   => $route_id,
        'route_name' => $route_name,
        'stops'      => $stops,
        'start_time' => $start_time,
        'end_time'   => $end_time
    ];
    include '../views/edit_route_form.php';
    exit();
}

// 6. Update and redirect
update_route($route_id, $route_name, $stops, $start_time, $end_time);
header('Location: ../admin_routes.php');
exit();
// Ensure that the update_route function is defined in route_db.php
// This function should handle the actual database update logic