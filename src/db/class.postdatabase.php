<?php

class PostDatabase extends Database {

    public static function getPostById($id) {
        $db = Database::getDb();

        $statement = $db->prepare("SELECT * FROM post WHERE Id = ?");
        $statement->execute([$id]);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        
        $result = $statement->fetch();
        
        $db = null;
        return $result;
    }

    public static function getPosts($type) {
        $db = Database::getDb();
        $result = array();

        $statement = $db->prepare("SELECT * FROM post WHERE Type = ?");
        $statement->execute([$type]);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        
        while($post = $statement->fetch()) {
            array_push($result, $post);
        }
        
        $db = null;
        return $result;
    }

    public static function addPost($type, $title, $content) {
        $db = Database::getDb();
        $creator = $_SESSION["user_data"]["Id"];
        $statement = $db->prepare("INSERT INTO post VALUES(?, ?, ?, ?, ?, ?)");
        $statement->execute([0, $title, $content, $creator, date("Y.m.d H:m:s"), $type]);

        return $statement->rowCount() == 1;
    }

    public static function getCommentsForPostById($id) {
        $db = Database::getDb();
        $result = array();

        $statement = $db->prepare("SELECT * FROM comment WHERE PostId = ?");
        $statement->execute([$id]);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        
        while($comment = $statement->fetch()) {
            array_push($result, $comment);
        }
        
        $db = null;
        return $result;
    }

    public static function addComment($postId, $content) {
        $db = Database::getDb();
        $creator = $_SESSION["user_data"]["Id"];
        $statement = $db->prepare("INSERT INTO comment VALUES(?, ?, ?, ?, ?)");
        $statement->execute([0, $creator, date("Y.m.d H:m:s"), $content, $postId]);

        return $statement->rowCount() == 1;
    }
}

?>