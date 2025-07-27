<?php
// models/route_db.php

require_once 'database.php';

/**
 * Fetch all routes.
 */
function get_routes(): array {
    global $db;
    $query = "
        SELECT
            id        AS route_id,
            routeName AS route_name,
            stops,
            startTime AS start_time,
            endTime   AS end_time
        FROM routes
    ";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $rows;
}

/**
 * Fetch a route by ID.
 */
function get_route(int $id): ?array {
    global $db;
    $query = "
        SELECT
            id        AS route_id,
            routeName AS route_name,
            stops,
            startTime AS start_time,
            endTime   AS end_time
        FROM routes
        WHERE id = :id
    ";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $route = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $route ?: null;
}

/**
 * Add a new route.
 */
function add_route(string $name, string $stops, string $start, string $end): void {
    global $db;
    $query = "
        INSERT INTO routes (routeName, stops, startTime, endTime)
        VALUES (:name, :stops, :start, :end)
    ";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':stops', $stops);
    $stmt->bindValue(':start', $start);
    $stmt->bindValue(':end', $end);
    $stmt->execute();
    $stmt->closeCursor();
}

/**
 * Update a route.
 */
function update_route(int $id, string $name, string $stops, string $start, string $end): void {
    global $db;
    $query = "
        UPDATE routes
        SET routeName = :name,
            stops = :stops,
            startTime = :start,
            endTime = :end
        WHERE id = :id
    ";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':stops', $stops);
    $stmt->bindValue(':start', $start);
    $stmt->bindValue(':end', $end);
    $stmt->execute();
    $stmt->closeCursor();
}

/**
 * Delete a route.
 */
function delete_route(int $id): void {
    global $db;
    $stmt = $db->prepare("DELETE FROM routes WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
}

/**
 * Record route attendance.
 */
function attend_route(int $user_id, int $route_id): void {
    global $db;
    $stmt = $db->prepare("
        INSERT INTO attendance (user_id, route_id)
        VALUES (:user_id, :route_id)
    ");
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':route_id', $route_id, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
}

/**
 * Remove an attendance record.
 */
function delete_attendance(int $attendance_id): void {
    global $db;
    $stmt = $db->prepare("DELETE FROM attendance WHERE id = :attendance_id");
    $stmt->bindValue(':attendance_id', $attendance_id, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
}

/**
 * Check if a user already attended a route.
 */
function check_if_attended(int $user_id, int $route_id): bool {
    global $db;
    $stmt = $db->prepare("
        SELECT COUNT(*)
        FROM attendance
        WHERE user_id = :user_id AND route_id = :route_id
    ");
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':route_id', $route_id, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    $stmt->closeCursor();
    return $count > 0;
}

/**
 * Get all attended routes for a user.
 */
function get_attended_routes(int $user_id): array {
    global $db;
    $stmt = $db->prepare("
        SELECT
            a.id        AS attendance_id,
            r.routeName AS route_name,
            r.stops,
            r.startTime AS start_time,
            r.endTime   AS end_time,
            a.attended_at
        FROM attendance AS a
        JOIN routes AS r ON a.route_id = r.id
        WHERE a.user_id = :user_id
        ORDER BY a.attended_at DESC
    ");
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $rows;
}

/**
 * Admin: fetch all attendance records.
 */
function get_all_attendance(): array {
    global $db;
    $stmt = $db->prepare("
        SELECT
            a.id        AS attendance_id,
            u.email     AS user_email,
            r.routeName AS route_name,
            a.attended_at
        FROM attendance AS a
        JOIN users AS u ON a.user_id = u.id
        JOIN routes AS r ON a.route_id = r.id
        ORDER BY a.attended_at DESC
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $rows;
}
