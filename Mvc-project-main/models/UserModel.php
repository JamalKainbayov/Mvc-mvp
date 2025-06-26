<?php
class UserModel {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=mvc_project', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function createUser($username, $email, $password, $role = 'user') {
        try {
            $stmt = $this->db->prepare('INSERT INTO users (username, email, password, role, created_at) VALUES (?, ?, ?, ?, NOW())');
            return $stmt->execute([$username, $email, $password, $role]);
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function getUserByUsername($username) {
        try {
            $stmt = $this->db->prepare('SELECT * FROM users WHERE username = ?');
            $stmt->execute([$username]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
}
?>
