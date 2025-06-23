<?php
class PostModel {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=mvc_project', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getAllPosts() {
        try {
            $stmt = $this->db->query('
                SELECT posts.*, users.username 
                FROM posts 
                JOIN users ON posts.user_id = users.id
                ORDER BY posts.created_at DESC
            ');
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function getPostById($id) {
        try {
            $stmt = $this->db->prepare('SELECT * FROM posts WHERE id = ?');
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function createPost($title, $content, $user_id) {
        try {
            $stmt = $this->db->prepare('INSERT INTO posts (title, content, user_id, created_at) VALUES (?, ?, ?, NOW())');
            $result = $stmt->execute([$title, $content, $user_id]);
            if (!$result) {
                throw new Exception("Failed to insert post");
            }
            return true;
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
}
?>
