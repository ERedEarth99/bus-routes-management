<?php
// controllers/edit_route.php
session_start();

if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

require_once '../models/database.php';
require_once '../models/route_db.php';

$route_id = filter_input(INPUT_GET, 'route_id', FILTER_VALIDATE_INT);

if (!$route_id) {
    header('Location: ../admin_routes.php');
    exit();
}

$route = get_route_by_id($route_id);  // You must have this function in route_db.php

if (!$route) {
    header('Location: ../admin_routes.php');
    exit();
}

include '../views/edit_route_form.php';
// Ensure that the route data is passed to the view
// This will be used in the edit_route_form.php to populate the form fields