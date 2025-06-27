<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter home</title>
    <link href="/Mvc-mvp/Mvc-project-main/css/home.css" rel="stylesheet">
</head>
<body>
<div class="top-bar">
    <?php if (isset($_SESSION['username'])): ?>
        <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
        <form action="index.php?action=logout" method="post" style="display:inline;">
            <button type="submit">Logout</button>
        </form>
    <?php else: ?>
        <a href="/Mvc-mvp/Mvc-project-main/index.php?action=login">
            <button type="button">Login</button>
        </a>
    <?php endif; ?>
</div>

<div>
    <?php if (isset($_SESSION['username'])): ?>
        <div class="post-form">
            <h2>Create a New Post</h2>
            <form action="index.php?action=create" method="post">
                <input type="text" name="title" placeholder="Title" required><br>
                <textarea name="content" rows="4" cols="50" placeholder="What's happening?" required></textarea><br>
                <input type="submit" value="Post">
            </form>
        </div>
    <?php endif; ?>

    <h2>Recent Posts</h2>
    <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <p><?php echo htmlspecialchars($post['content']); ?></p>
                <small>Posted by: <?php echo isset($post['username']) ? htmlspecialchars($post['username']) : 'Unknown'; ?> on <?php echo $post['created_at']; ?></small>

                <div class="like-section">
                    <?php if (isset($_SESSION['username'])): ?>
                        <?php if ($post['liked']): ?>
                            <a href="index.php?action=unlike&id=<?= $post['id'] ?>">💔 Unlike</a>
                        <?php else: ?>
                            <a href="index.php?action=like&id=<?= $post['id'] ?>">❤️ Like</a>
                        <?php endif; ?>
                    <?php endif; ?>
                    <span><?= $post['like_count'] ?> like<?= $post['like_count'] != 1 ? 's' : '' ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No posts yet.</p>
    <?php endif; ?>
</div>

<div class="footer">
    Welcome to My twitter site<br>
    &copy; 2023 M. Wissenburg J. Kainbayov
</div>
</body>
</html>
