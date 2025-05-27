<?php
namespace App\Database;

use PDO;
use PDOException;

class Connection {
    public static function getInstance(): PDO {
        $host = $_ENV['DB_HOST'];
        $db = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
        return new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
}