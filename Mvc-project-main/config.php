<?php
// config.php

$host = 'localhost';  // Je hostnaam
$dbname = 'blog_project';  // Je database naam
$username = 'root';  // Je database gebruikersnaam
$password = '';  // Je database wachtwoord

try {
    // Maak verbinding met de database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbinding mislukt: " . $e->getMessage());
}
