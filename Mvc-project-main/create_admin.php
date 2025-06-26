<?php

require_once 'models/UserModel.php';

try {
    $userModel = new UserModel();
    

    $username = 'admin';
    $email = 'admin@example.com';
    $password = password_hash('admin123', PASSWORD_DEFAULT);
    $role = 'admin';
    

    $existingUser = $userModel->getUserByUsername($username);
    
    if ($existingUser) {
        echo "Admin user already exists!\n";
        echo "Username: " . $existingUser['username'] . "\n";
        echo "Email: " . $existingUser['email'] . "\n";
    } else {

        $result = $userModel->createUser($username, $email, $password, $role);
        
        if ($result) {
            echo "Admin user created successfully!\n";
            echo "Username: $username\n";
            echo "Email: $email\n";
            echo "Password: admin123 (please change this!)\n";
            echo "Role: $role\n";
        } else {
            echo "Failed to create admin user.\n";
        }
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "\nMake sure you have:\n";
    echo "1. Created the database 'mvc_project'\n";
    echo "2. Run the SQL from Databases/mvc_project.sql\n";
    echo "3. Run the SQL from Databases/add_role_column.sql\n";
}
?>
