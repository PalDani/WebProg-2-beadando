<?php

class APIDatabase extends Database {

    public static function addPost($type, $title, $content, $creator) {
        $db = Database::getDb();
        $statement = $db->prepare("INSERT INTO post VALUES(?, ?, ?, ?, ?, ?)");
        $statement->execute([0, $title, $content, $creator, date("Y.m.d H:m:s"), $type]);

        $result = array("result" => $statement->rowCount() > 0, "affectedrows" => $statement->rowCount());

        return $result;
    }

    public static function getPosts($type) {
        $db = Database::getDb();
        $posts = array();

        $statement = $db->prepare("SELECT * FROM post WHERE Type = ?");
        $statement->execute([$type]);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        
        while($post = $statement->fetch()) {
            array_push($posts, $post);
        }
        
        $result = array("result" => true,"posts" => $posts, "count" => sizeof($posts));
        $db = null;
        return $result;
    }

    public static function getPostById($id) {
        $db = Database::getDb();
        $posts = array();

        $statement = $db->prepare("SELECT * FROM post WHERE Id = ?");
        $statement->execute([$id]);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        
        $post = $statement->fetch();
        
        $result = array("result" => true,"post" => $post);
        $db = null;
        return $result;
    }
}
?>