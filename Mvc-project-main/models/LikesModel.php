<?php
class Like {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=mvc_project', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
    }

    public function addLike($userId, $postId) {
        $stmt = $this->db->prepare("INSERT INTO likes (user_id, post_id) VALUES (:user_id, :post_id)");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':post_id', $postId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function removeLike($userId, $postId) {
        $stmt = $this->db->prepare("DELETE FROM likes WHERE user_id = :user_id AND post_id = :post_id");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':post_id', $postId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function isLiked($userId, $postId) {
        $stmt = $this->db->prepare("SELECT id FROM likes WHERE user_id = :user_id AND post_id = :post_id");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':post_id', $postId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }

    public function countLikes($postId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM likes WHERE post_id = :post_id");
        $stmt->bindValue(':post_id', $postId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? $result->total : 0;
    }
}

