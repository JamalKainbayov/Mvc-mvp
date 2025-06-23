<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="/Mvc-mvp/Mvc-project-main/css/login.css" />
    <title>Register</title>
</head>
<body>
<h1>Register</h1>

<?php if (!empty($error)): ?>
    <p style="color:red; text-align:center;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form action="/Mvc-mvp/Mvc-project-main/index.php?action=register" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required />

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required />

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required />

    <button type="submit">Register</button>
</form>


<div class="register-container" style="max-width: 400px; margin: 20px auto; text-align: center;">
    <p>Already have an account?</p>
    <a href="/Mvc-mvp/Mvc-project-main/index.php?action=login">
        <button type="button">Login</button>
    </a>
</div>
</body>
</html>
