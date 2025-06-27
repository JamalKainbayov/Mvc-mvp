<?php

require_once __DIR__ . '/../models/PostModel.php';
require_once __DIR__ . '/../models/LikesModel.php';


class PostController
{
    private $postModel;
    private $likeModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->likeModel = new Like();
    }

    public function like($id)
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        if (!is_numeric($id)) {
            header('Location: index.php?action=index');
            exit;
        }

        if (!$this->likeModel->isLiked($_SESSION['user_id'], $id)) {
            $this->likeModel->addLike($_SESSION['user_id'], $id);
        }

        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'index.php?action=index'));
        exit;
    }

    public function unlike($id)
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        if (!is_numeric($id)) {
            header('Location: index.php?action=index');
            exit;
        }

        if ($this->likeModel->isLiked($_SESSION['user_id'], $id)) {
            $this->likeModel->removeLike($_SESSION['user_id'], $id);
        }

        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'index.php?action=index'));
        exit;
    }

    public function index()
    {
        $posts = $this->postModel->getAllPosts();

        foreach ($posts as &$post) {
            $post['like_count'] = $this->likeModel->countLikes($post['id']);
            $post['liked'] = isset($_SESSION['user_id']) && $this->likeModel->isLiked($_SESSION['user_id'], $post['id']);
        }

        $title = "Home";

        ob_start();
        require __DIR__ . '/../views/home.php';
        $content = ob_get_clean();

        require __DIR__ . '/../views/layout.php';
    }

    public function create()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            $user_id = $_SESSION['user_id'];
            $role = $_SESSION['user']['role'] ?? 'user';

            if (empty($title) || empty($content)) {
                echo "Title and content cannot be empty";
                return;
            }

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
