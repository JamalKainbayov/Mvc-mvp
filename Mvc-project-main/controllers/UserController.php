<?php
class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
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
                if ($this->userModel->createUser($username, $email, $password)) {
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
                $user = $this->userModel->getUserByUsername($username);
                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'email' => $user['email'],
                        'username' => $user['username']
                    ];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['user_id'] = $user['id']; // <-- THIS LINE FIXES THE LOGIN CHECK

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
