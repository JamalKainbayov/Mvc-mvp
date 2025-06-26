<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/Mvc-mvp/mvc-project-main/css/style.css">

</head>
<body>
    <?php include __DIR__ . '/../layout.php'; ?>
    
    <div class="admin-dashboard">
        <h1>Admin Dashboard</h1>
        <p>Welkom, <?php echo htmlspecialchars($_SESSION['user']['username']); ?>!</p>
        
        <?php if (isset($stats['db_warning'])): ?>
            <div style="background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 5px; margin: 20px 0; color: #856404;">
                <strong>Database Warning:</strong> <?php echo htmlspecialchars($stats['db_warning']); ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($stats['db_error'])): ?>
            <div style="background: #f8d7da; border: 1px solid #f1aeb5; padding: 15px; border-radius: 5px; margin: 20px 0; color: #721c24;">
                <strong>Database Error:</strong> <?php echo htmlspecialchars($stats['db_error']); ?>
            </div>
        <?php endif; ?>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?php echo $stats['user_count']; ?></div>
                <div class="stat-label">Total Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $stats['post_count']; ?></div>
                <div class="stat-label">Total Posts</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo count($stats['recent_users']); ?></div>
                <div class="stat-label">Recent Users</div>
            </div>
        </div>
        
        <div class="recent-users">
            <h3>Recent Users</h3>
            <?php if (!empty($stats['recent_users'])): ?>
                <ul class="user-list">
                    <?php foreach ($stats['recent_users'] as $user): ?>
                        <li class="user-item">
                            <span><strong><?php echo htmlspecialchars($user['username']); ?></strong> - <?php echo htmlspecialchars($user['email']); ?></span>
                            <span><?php echo date('M j, Y', strtotime($user['created_at'])); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No users found.</p>
            <?php endif; ?>
        </div>
        
        <div class="admin-actions">
            <h3>Admin Actions</h3>
            <div class="action-buttons">
                <a href="index.php?action=admin-users" class="btn btn-primary">Manage Users</a>
                <a href="index.php?action=index" class="btn btn-primary">View All Posts</a>
                <a href="index.php?action=create" class="btn btn-success">Create New Post</a>
                <a href="index.php?action=home" class="btn btn-warning">Back to Home</a>
            </div>
        </div>
    </div>
</body>
</html>
