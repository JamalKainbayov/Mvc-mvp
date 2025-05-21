<?php
$host = 'localhost';
$dbname = 'voorbeelddb';
$username = 'root';
$password = '';

$pdo = null;

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    throw new Exception("Connection failed: " . $e->getMessage());
}