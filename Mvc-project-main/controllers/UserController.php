<?php
require_once __DIR__ . '/../models/UserModel.php';

use App\Models\User; // Aangenomen dat je een User ORM-model hebt in deze namespace

class UserController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            try {
                $user = new User();
                $user->username = $username;
                $user->email = $email;
                $user->password = $password;

                if ($user->save()) {
                    header('Location: /Mvc-mvp/Mvc-project-main/index.php?action=login');
                    exit;
                } else {
                    throw new Exception("Error registering user");
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            require __DIR__ . '/../views/register.php';
        }
    }

    public function login()
{
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        try {
            $user = User::where('username', $username); 

            if ($user && password_verify($password, $user->password)) {
                $_SESSION['user'] = [
                    'id' => $user->id,
                    'email' => $user->email,
                    'username' => $user->username,
                    'role' => $user->role ?? 'user',
                ];
                $_SESSION['username'] = $user->username;
                $_SESSION['user_id'] = $user->id;

                header('Location: /Mvc-mvp/Mvc-project-main/index.php');
                exit;
            } else {
                $error = "Invalid username or password";
            }
        } catch (Exception $e) {
            $error = "Error: " . $e->getMessage();
        }
    }

    require __DIR__ . '/../views/login.php';
}
}
?>
