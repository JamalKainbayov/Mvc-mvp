<?php
$host = 'localhost';
$dbname = 'U mad';
$username = 'root';
$password = '';

$pdo = null;

try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    throw new Exception("Connection failed: " . $e->getMessage());
}