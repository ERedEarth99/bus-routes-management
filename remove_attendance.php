<?php
// remove_attendance.php
session_start();

require_once 'models/database.php';
require_once 'models/attendance_db.php';

// Only admin can remove
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

// Handle removal
$attendance_id = filter_input(INPUT_POST, 'attendance_id', FILTER_VALIDATE_INT);

if ($attendance_id) {
    delete_attendance($attendance_id);
}

header('Location: admin_attendance.php');
exit();
