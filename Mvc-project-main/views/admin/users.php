<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Admin</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .admin-users {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .users-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .users-table th,
        .users-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        .users-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #495057;
        }
        .users-table tr:hover {
            background-color: #f8f9fa;
        }
        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .back-btn:hover {
            background-color: #5a6268;
        }
        .role-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        .role-admin {
            background-color: #dc3545;
            color: white;
        }
        .role-user {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../sidebar.php'; ?>
    
    <div class="admin-users">
        <a href="index.php?action=admin" class="back-btn">← Back to Dashboard</a>
        
        <h1>User Management</h1>
        
        <?php if (!empty($users)): ?>
            <table class="users-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td>
                                <span class="role-badge role-<?php echo htmlspecialchars($user['role']); ?>">
                                    <?php echo ucfirst(htmlspecialchars($user['role'])); ?>
                                </span>
                            </td>
                            <td><?php echo date('M j, Y g:i A', strtotime($user['created_at'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No users found in the database.</p>
        <?php endif; ?>
    </div>
</body>
</html>
