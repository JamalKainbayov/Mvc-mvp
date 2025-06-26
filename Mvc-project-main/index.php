<?php
session_start();

if (!isset($_GET['action'])) {
    header('Location: index.php?action=index');
    exit;
}

spl_autoload_register(function ($class_name) {
    $directories = [
        __DIR__ . '/controllers/',
        __DIR__ . '/models/'
    ];

    foreach ($directories as $directory) {
        $file = $directory . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'index':
    case 'home':
        $controller = new PostController();
        $controller->index();
        break;

    case 'create':
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }
        $controller = new PostController();
        $controller->create();
        break;

    case 'detail':
        if ($id) {
            $controller = new PostController();
            $controller->detail($id);
        } else {
            echo "404 - Page not found";
        }
        break;

    case 'register':
        $userController = new UserController();
        $userController->register();
        break;

    case 'login':
        $userController = new UserController();
        $userController->login();
        break;

    case 'logout':
        session_destroy();
        header('Location: index.php?action=login');
        exit;
        break;

    case 'admin':
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: index.php?action=login');
            exit;
        }
        $controller = new AdminController();
        $controller->index();
        break;

    case 'admin-users':
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: index.php?action=login');
            exit;
        }
        $controller = new AdminController();
        $controller->manageUsers();
        break;

    default:
        echo "404 - Page not found";
        break;
}
?>
