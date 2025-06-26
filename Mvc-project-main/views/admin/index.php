<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/Mvc-mvp/mvc-project-main/css/style.css">
    <style>
        .admin-dashboard {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }
        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }
        .recent-users {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
        }
        .recent-users h3 {
            margin-top: 0;
            color: #495057;
        }
        .user-list {
            list-style: none;
            padding: 0;
        }
        .user-item {
            padding: 10px 0;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
        }
        .user-item:last-child {
            border-bottom: none;
        }
        .admin-actions {
            margin-top: 30px;
        }
        .admin-actions h3 {
            color: #495057;
        }
        .action-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-success {
            background-color: #28a745;
        }
        .btn-warning {
            background-color: #ffc107;
            color: #212529;
        }
        .btn:hover {
            opacity: 0.8;
        }
    </style>
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
