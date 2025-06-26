<?php

class AdminController {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=mvc_project', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function index() {
       

        if (!isset($_SESSION['user'])) {
            // Niet ingelogd
            header('Location: index.php?action=login');
            exit;
        }

        $user = $_SESSION['user'];

        if ($user['role'] !== 'admin') {
            // Geen toegang
            http_response_code(403);
            echo "403 Forbidden – Alleen voor admins";
            exit;
        }

        // Get statistics for dashboard
        $stats = $this->getDashboardStats();

        // Adminpagina tonen
        require_once __DIR__ . '/../views/admin/index.php';
    }

    private function getDashboardStats() {
        try {
            // Count users - check if role column exists
            $stmt = $this->db->query('SHOW COLUMNS FROM users LIKE "role"');
            $hasRoleColumn = $stmt->fetch() !== false;
            
            if (!$hasRoleColumn) {
                // Role column doesn't exist, show warning
                return [
                    'user_count' => 0,
                    'post_count' => 0,
                    'recent_users' => [],
                    'db_warning' => 'Role column missing. Please run add_role_column.sql'
                ];
            }

            // Count users
            $stmt = $this->db->query('SELECT COUNT(*) as user_count FROM users');
            $userCount = $stmt->fetch(PDO::FETCH_ASSOC)['user_count'];

            // Count posts
            $stmt = $this->db->query('SELECT COUNT(*) as post_count FROM posts');
            $postCount = $stmt->fetch(PDO::FETCH_ASSOC)['post_count'];

            // Get recent users
            $stmt = $this->db->query('SELECT username, email, created_at FROM users ORDER BY created_at DESC LIMIT 5');
            $recentUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'user_count' => $userCount,
                'post_count' => $postCount,
                'recent_users' => $recentUsers
            ];
        } catch (PDOException $e) {
            error_log("Admin dashboard stats error: " . $e->getMessage());
            return [
                'user_count' => 0,
                'post_count' => 0,
                'recent_users' => [],
                'db_error' => $e->getMessage()
            ];
        }
    }

    public function manageUsers() {

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: index.php?action=login');
            exit;
        }

        try {
            $stmt = $this->db->query('SELECT id, username, email, role, created_at FROM users ORDER BY created_at DESC');
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            require_once __DIR__ . '/../views/admin/users.php';
        } catch (PDOException $e) {
            echo "Error loading users: " . $e->getMessage();
        }
    }
}
