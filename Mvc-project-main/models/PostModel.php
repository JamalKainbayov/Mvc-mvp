<?php
class PostModel {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=blog_project', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getAllPosts() {
        try {
            $stmt = $this->db->query('SELECT * FROM posts');
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

    public function createPost($title, $content) {
        try {
            $stmt = $this->db->prepare('INSERT INTO posts (title, content, created_at) VALUES (?, ?, NOW())');
            $result = $stmt->execute([$title, $content]);
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