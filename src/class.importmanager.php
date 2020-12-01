<?php

require_once("conf.php");

class ImportManager {
    public static function load($fileName) {
        if(file_exists($fileName)) {
            include_once(getConfig()["root_dir"] . "/$fileName");
        }
    }
}

?>