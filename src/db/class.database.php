<?php

class Database {
    
    protected static function getDb() {
        try {
            $host = getConfig()["database"]["host"];
            $port = getConfig()["database"]["port"];
            $user = getConfig()["database"]["username"];
            $pass = getConfig()["database"]["password"];
            $dbname = getConfig()["database"]["db_name"];

            $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("set names utf8");
            
            return $pdo;
        } catch(PDOException $ex) {
            echo "Connection failed: " . $ex->getMessage();
        }
    }

}

?>