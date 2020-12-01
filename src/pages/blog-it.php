<?php

ImportManager::load("src/db/class.postdatabase.php");
ImportManager::load("src/db/class.authdatabase.php");

if(isset($_POST["post_name"])) {
    if(PostDatabase::addPost(1, $_POST["post_name"], $_POST["post_content"])) {
        echo '<div class="alert alert-success" role="alert">Poszt létrehozva.</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Sikertelen létrehozás.</div>';
    }
}

if(isset($_POST["comment_content"])) {
    PostDatabase::addComment($_POST["comment_post_id"], $_POST["comment_content"]); 
}

if(isset($_SESSION["user_data"]) && $_SESSION["user_data"]["Role"] >= 2) {
    echo '<div class="d-flex flex-column align-items-center border border-primary rounded"><form method="post">';
    echo '<div class="p-2 text-center"><h3>Új poszt</h3></div>';
    echo '<div class="p-2"><input type="text" name="post_name" id="post_name" placeholder="Cím"></div>';
    echo '<div class="p-2"><textarea name="post_content" id="post_content" placeholder="Poszt tartalma"></textarea></div>';
    echo '<div class="p-2"><input type="submit" value="Létrehoz"></div>';
    echo '</form></div>';
}

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container">
    <?php

    foreach(PostDatabase::getPosts(1) as $post) {
        echo "<div class='border border-secondary rounded padded post justify-content-md-center'><div class='text-center'><h4>" . $post["Title"] . "(" . AuthDatabase::getUserById($post["Creator"])["Username"] . " - " . $post["CreateDate"] . ")</h4></div>";
        echo "<div><hr>" . $post["Content"] . "</div>";
        if(sizeof(PostDatabase::getCommentsForPostById($post["Id"])) > 0)
            echo "<hr>";
        foreach(PostDatabase::getCommentsForPostById($post["Id"]) as $comment) {
            echo "<div class='border border-info'><div class='font-weight-bold'>" . AuthDatabase::getUserById($comment["Creator"])["Username"] . " - " . $comment["CreateDate"] . "</div>";
            echo "<div class='font-italic'>" . $comment["Content"] . "</div>";
            echo "</div>";
        }
        if(isset($_SESSION["user_data"])&& $_SESSION["user_data"]["Role"] >= 1) {
            echo "<hr>";
            echo '<div class="d-flex flex-column align-items-center border border-primary rounded"><form method="post"><input type="hidden" name="comment_post_id" id="comment_post_id" value="' . $post["Id"] . '"';
            echo '<div class="p-2"><textarea class="postwriter" name="comment_content" id="comment_content" placeholder="Poszt tartalma" required></textarea></div>';
            echo '<div class="p-2"><input type="submit" value="Létrehoz"></div>';
            echo '</form></div>';
        }
        echo "</div>";
    }

    ?>
    </div>
</body>
</html>