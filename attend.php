<?php
// attend.php
session_start();

require_once 'models/database.php';
require_once 'models/route_db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header('Location: login.php');
    exit();
}

$route_id = filter_input(INPUT_POST, 'route_id', FILTER_VALIDATE_INT);

if (!$route_id) {
    $error = "Invalid route selection.";
    include 'views/error.php';
    exit();
}

$user_id = $_SESSION['user_id'];

if (!check_if_attended($user_id, $route_id)) {
    attend_route($user_id, $route_id);
}

header('Location: my_routes.php');
exit();
