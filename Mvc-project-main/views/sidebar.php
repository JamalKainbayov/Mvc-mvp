<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="nav">
    <h2>X</h2>
    <ul>
        <li><a href="/index.php?action=home">Home</a></li>
        <li><a href="/index.php?action=users">Profile</a></li>
        <li><a href="#">Notifications</a></li>
        <li><a href="#">Messages</a></li>
        <li><a href="#">Settings</a></li>

  <?php
    if (
      isset($_SESSION['user']) &&
      isset($_SESSION['user']['role']) &&
      $_SESSION['user']['role'] === 'admin'
  ): ?>
    <li><a href="index.php?action=admin">Admin</a></li>
  <?php endif; ?>

    </ul>
</nav>
