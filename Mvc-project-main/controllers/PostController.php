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
                        require __DIR__ . '/../views/home.php';
                    }

                    public function create()
                    {
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $title = $_POST['title'] ?? ''; 
                            $content = $_POST['content'] ?? '';

                            try {
                                if ($this->postModel->createPost($title, $content)) {
                                    header('Location: index.php');
                                    exit;
                                } else {
                                    throw new Exception("Error creating post");
                                }
                            } catch (Exception $e) {
                                echo "Error: " . $e->getMessage();
                                // You might want to log this error 
                            }
                        } else {
                            echo "Invalid request method";
                        }
                    }
                }