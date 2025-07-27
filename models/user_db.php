<?php
// models/user_db.php

/**
 * Fetch a user row (including role) by email.
 *
 * @param string $email
 * @return array|null
 */
function get_user_by_email(string $email): ?array {
    global $db;
    $query = "
      SELECT
        id,
        email,
        password,
        role
      FROM users
      WHERE email = :email
    ";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $user ?: null;
}

function get_user_by_id(int $id): ?array {
    global $db;
    $query = "
      SELECT 
        id,
        email,
        password,
        role
      FROM users
      WHERE id = :id
    ";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $user ?: null;
}

function create_user($email, $hash) {
    global $db;
    $stmt = $db->prepare(
      "INSERT INTO users (email, password)
       VALUES (:email, :password)"
    );
    $stmt->bindValue(':email',    $email);
    $stmt->bindValue(':password', $hash);
    $stmt->execute();
    $stmt->closeCursor();
}
function is_admin_user(int $user_id): bool {
    global $db;
    $stmt = $db->prepare("
      SELECT COUNT(*) 
      FROM admins
      WHERE user_id = :user_id
    ");
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    $stmt->closeCursor();
    return $count > 0;
}
function get_user_role(int $user_id): ?string {
    global $db;
    $stmt = $db->prepare("
      SELECT role 
      FROM admins 
      WHERE user_id = :user_id
    ");
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $role = $stmt->fetchColumn();
    $stmt->closeCursor();
    return $role ?: null;
}   