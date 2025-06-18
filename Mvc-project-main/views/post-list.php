<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="public/css/style.css">
    <title>Blog - Posts</title>
</head>
<body>
    <h1>Blog Posts</h1>
    <?php foreach ($posts as $post): ?>
        <h2><a href="/?action=detail&id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h2>
        <p><?= substr(htmlspecialchars($post['content']), 0, 100) ?>...</p>
    <?php endforeach; ?>
    <a href="/?action=create">Nieuwe post maken</a>
</body>
</html>
