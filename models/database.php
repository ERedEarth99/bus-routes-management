<?php
// models/database.php
$dsn      = 'mysql:host=localhost;dbname=busroutedb;charset=utf8';
$username = 'root';
$password = '';
$options  = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}
