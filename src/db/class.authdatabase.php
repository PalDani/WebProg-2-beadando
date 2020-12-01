<?php

require_once("class.database.php");

class AuthDatabase extends Database {

    public static function userLogin($username, $password) {
        $db = Database::getDb();

        $statement = $db->prepare("SELECT COUNT(Id) AS Res FROM user WHERE Username = ? OR Email = ? AND password = ?");
        $statement->execute([$username, $username, md5($password)]);
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetch();

        $db = null;
        if($result["Res"] == 1) {
            $_SESSION["user_data"] = AuthDatabase::getUserByUsername($username);
            return true;
        } else return false;
    }

    public static function userExists($username) {
        $db = Database::getDb();

        $statement = $db->prepare("SELECT COUNT(Id) FROM user WHERE Username = ?");
        $statement->execute([$username]);
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetch();

        $db = null;
        return $result == 1 ? true : false;
    }

    public static function emailExists($email) {
        $db = Database::getDb();

        $statement = $db->prepare("SELECT COUNT(Id) FROM user WHERE Email = ?");
        $statement->execute([$email]);
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetch();

        $db = null;
        return $result == 1 ? true : false;
    }

    public static function userRegister($username, $email, $password, $password_again) {
        if($password != $password_again)
            return false;

        if(AuthDatabase::userExists($username) || AuthDatabase::emailExists($email))
            return false;
            
        $db = Database::getDb();

        $statement = $db->prepare("INSERT INTO user VALUES(?, ?, ?, ?, ?, ?)");
        $statement->execute([0, $username, $email, md5($password), date("Y.m.d H:m:s"), 1]);
        
        return $statement->rowCount() == 1 ? true : false;
    }

    public static function getUserByUsername($username) {
        $db = Database::getDb();

        $statement = $db->prepare("SELECT Id, Username, Email, Role FROM user WHERE Username = ?");
        $statement->execute([$username]);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        
        $result = $statement->fetch();
        
        $db = null;
        return $result;
    }

    public static function getUserById($id) {
        $db = Database::getDb();

        $statement = $db->prepare("SELECT Id, Username, Email, Role FROM user WHERE Id = ?");
        $statement->execute([$id]);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        
        $result = $statement->fetch();
        
        $db = null;
        return $result;
    }
}

?>