<?php
// src/DBconnect.php
$host = 'localhost';
$dbname = 'test';
$username = 'root';
$password = 'pass';

try {
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $connection; // Return the connection object
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>