<?php
require_once __DIR__ . "/dbConnect.php";

class SalesModel{
    //Creates database table if it doesnt exist yet.
    public static function initializeDatabase(){
        global $pdo;
        $pdo->prepare(
            "CREATE TABLE IF NOT EXISTS sales (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            body TEXT NOT NULL,
            price DECIMAL NOT NULL,
            date DATETIME NOT NULL
            );")->execute();
    }

    public static function getMainSale(){
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM sales ORDER BY date DESC LIMIT 1");
        $stmt->execute();
        $result = $stmt->fetchAll();
        if(count($result) != 1){
            //No sale found
            return null;
        }
        return $result[0];
    }
}