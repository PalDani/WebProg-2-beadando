<?php

require_once("class.database.php");

class PageDatabase extends Database {
    public static function getPages() {
        $result = array();

        $db = Database::getDb();

        $statement = $db->prepare("SELECT * FROM menu");
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        
        while($page = $statement->fetch()) {
            array_push($result, $page);
        }

        $db = null;
        return $result;
    }

    public static function getPagesByParent($parent) {
        $result = array();

        $db = Database::getDb();

        $statement = $db->prepare("SELECT * FROM menu WHERE Parent = ?");
        $statement->execute([$parent]);

        $statement->setFetchMode(PDO::FETCH_ASSOC);
        while($page = $statement->fetch()) {
            array_push($result, $page);
        }

        $db = null;
        return $result;
    }

    public static function getPageById($id) {
        $db = Database::getDb();

        $statement = $db->prepare("SELECT * FROM menu WHERE Id = ?");
        $statement->execute([$id]);

        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetch();

        $db = null;
        return $result;
    }

    public static function getPageByParentId($parent) {
        $db = Database::getDb();

        $statement = $db->prepare("SELECT * FROM menu WHERE Parent = ?");
        $statement->execute([$parent]);

        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetch();
        $db = null;
        return $result;
    }

    public static function isRootMenu($id) {
        $db = Database::getDb();
        $statement = $db->prepare("SELECT COUNT(Id) AS Res FROM menu WHERE Parent IS NULL AND Id = ?");
        $statement->execute([$id]);

        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetch();
        $db = null;

        return $result["Res"] == 1 ? true : false;
    }

    public static function pageExists($id) {
        $db = Database::getDb();
        $statement = $db->prepare("SELECT COUNT(Id) AS Res FROM menu WHERE Id = ?");
        $statement->execute([$id]);

        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetch();
        $db = null;
        
        return $result["Res"] == 1 ? true : false;
    }
}

?>