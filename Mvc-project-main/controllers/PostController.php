<?php

require_once __DIR__ . '/../models/PostModel.php';

class PostController
{
    private $postModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
    }

    public function index()
    {
        $posts = $this->postModel->getAllPosts();
        $title = "Home";

        // Render the home view
        ob_start();
        require __DIR__ . '/../views/home.php';
        $content = ob_get_clean();

        require __DIR__ . '/../views/layout.php';
    }

    public function create()
    {
        // No session_start here because it's started in index.php

        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            $user_id = $_SESSION['user_id']; // Now user_id is set on login

            if ($this->postModel->createPost($title, $content, $user_id)) {
                header('Location: index.php?action=index');
                exit;
            } else {
                echo "Error creating post";
            }
        } else {
            echo "Invalid request method";
        }
    }
}
?>
