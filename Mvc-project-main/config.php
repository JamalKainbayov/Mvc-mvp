<?php
// config.php

$host = 'localhost';
$dbname = 'mvc_project';
$username = 'root';
$password = '';

try {
    // verbinding met database maken
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbinding mislukt: " . $e->getMessage());
}
