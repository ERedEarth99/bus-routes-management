<?php
// models/attendance_db.php

require_once 'database.php';

function get_all_attendance() {
    global $db;
    $query = 'SELECT a.attendance_id, u.email, r.route_name, a.attended_at
              FROM attendance a
              JOIN users u ON a.user_id = u.id
              JOIN routes r ON a.route_id = r.route_id
              ORDER BY a.attended_at DESC';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}

function delete_attendance($attendance_id) {
    global $db;
    $query = 'DELETE FROM attendance WHERE attendance_id = :attendance_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':attendance_id', $attendance_id);
    $statement->execute();
    $statement->closeCursor();
}
?>
