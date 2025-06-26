<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'My App') ?></title>
    <link rel="stylesheet" href="/Mvc-mvp/mvc-project-main/css/style.css">
</head>
<body>
<div class="container">
    <div class="sidebar">
        <?php include 'sidebar.php'; ?>
    </div>

    <div class="main-content">
        <?= $content ?? '' ?>
    </div>
</div>
</body>
</html>
