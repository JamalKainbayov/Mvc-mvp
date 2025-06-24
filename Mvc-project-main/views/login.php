<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="/Mvc-mvp/Mvc-project-main/css/login.css" />
    <title>Login</title>
</head>
<body>
<h1>Login</h1>

<?php if (!empty($error)) : ?>
    <div class="error-message"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form action="/Mvc-mvp/Mvc-project-main/index.php?action=login" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required />

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required />

    <button type="submit">Login</button>
</form>

<div class="register-container">
    <p>Don't have an account?</p>
    <a href="/Mvc-mvp/Mvc-project-main/index.php?action=register">
        <button type="button">Register</button>
    </a>
</div>
</body>
</html>
