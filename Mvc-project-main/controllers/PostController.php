<?php

                require_once __DIR__ . '/../models/PostModel.php';

                class PostController
                {
                    private $postModel;

                    public function __construct()
                    {
                        $this->postModel = new PostModel();
                        include 'views/layout.php';
                    }


                    public function index()
                    {
                        $posts = $this->postModel->getAllPosts();
                        require __DIR__ . '/../views/home.php';

                        $title = "Home";

                        ob_start();
                        
                        $content = ob_get_clean();



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

                            }
                        } else {
                            echo "Invalid request method";
                        }
                    }

                }

