<?php
spl_autoload_register(function ($class_name) {
    $directories = [
        'controllers' => __DIR__ . '/controllers/',
        'models' => __DIR__ . '/models/'
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

if ($action === 'index') {
    $controller = new PostController();
    $controller->index();

} elseif ($action === 'create') {
    $controller = new PostController();
    $controller->create();

} elseif ($action === 'detail' && $id) {
    $controller = new PostController();
    $controller->detail($id);

} elseif ($action === 'register') {
    $controller = new UserController();
    $controller->register();

} elseif ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new UserController();
    $controller->login();

} elseif ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UserController();
    $controller->handleLogin();

} else {
    echo "404 - Page not found";
}
