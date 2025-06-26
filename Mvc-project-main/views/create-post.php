<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="public/css/style.css">
    <title>Nieuwe Post</title>
</head>
<body>
<h1>Nieuwe Post</h1>
<form method="POST"action="/?action=create">
    <label for="title">Titel:</label>
    <input type="text" id="title" name="title" required>
    <label for="content">Content:</label>
    <textarea id="content" name="content" required></textarea>
    <button type="submit">Post Maken</button>
</form>
</body>
</html>
