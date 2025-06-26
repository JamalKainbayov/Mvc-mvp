<?php
namespace App\Models;

use PDO;
use PDOException;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=localhost;dbname=mvc_project", "root", "");
    }

    public static function where($column, $value)
    {
        $instance = new self();
        $stmt = $instance->db->prepare("SELECT * FROM users WHERE $column = :value LIMIT 1");
        $stmt->bindParam(':value', $value);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $userObj = new self();
            foreach ($user as $key => $val) {
                $userObj->$key = $val;
            }
            return $userObj;
        }
        return null;
    }

    public function save()
    {
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        return $stmt->execute([
            ':username' => $this->username,
            ':email' => $this->email,
            ':password' => $this->password,
        ]);
    }

    public function __get($name)
    {
        return $this->$name ?? null;
    }
}
