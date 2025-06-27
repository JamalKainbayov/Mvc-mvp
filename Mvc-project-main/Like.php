<?php
session_start();
header('Content-Type: application/json');

require_once 'models/LikesModel.php';

if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$userId = $_SESSION['user_id'];
$postId = $_POST['post_id'] ?? null;

if (!$postId) {
    echo json_encode(['success' => false, 'message' => 'Missing post ID']);
    exit;
}

$like = new Like();

if (!$like->isLiked($userId, $postId)) {
    $like->addLike($userId, $postId);
    $liked = true;
} else {
    $like->removeLike($userId, $postId);
    $liked = false;
}

$total = $like->countLikes($postId);

echo json_encode([
    'success' => true,
    'liked' => $liked,
    'total' => $total
]);