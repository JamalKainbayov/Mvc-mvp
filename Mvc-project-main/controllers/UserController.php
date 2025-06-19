<?php
class UserController {
    public function login() {
        require 'views/login.php';
    }

    public function handleLogin() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($username === 'admin' && $password === 'admin') {
            echo "Login successful!";
        } else {
            echo "Invalid username or password.";
        }
    }

    public function register() {
        echo "Register page not implemented yet.";
    }
}
