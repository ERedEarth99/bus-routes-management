<?php
session_start();

require_once '../models/database.php';
require_once '../models/route_db.php';

// Only allow if admin
if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Add route
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'add') {
    $name  = $_POST['route_name'] ?? '';
    $stops = $_POST['stops'] ?? '';
    $start = $_POST['start_time'] ?? '';
    $end   = $_POST['end_time'] ?? '';

    if ($name && $stops && $start && $end) {
        add_route($name, $stops, $start, $end);
    }

    header('Location: ../admin_routes.php');
    exit();
}

// Delete route
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    $id = $_POST['id'] ?? null;
    if ($id) {
        delete_route((int)$id);
    }

    header('Location: ../admin_routes.php');
    exit();
}

