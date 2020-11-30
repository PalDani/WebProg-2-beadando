<?php

$config = array(
    "database" => array(
        "host" => "127.0.0.1",
        "port" => "3306",
        "username" => "root",
        "password" => "",
        "db_name" => "webprog2_beadando",
        "charset" => "utf8"
    ),
    "auth" => array(
        "default_role" => 1
    ),
    "root_dir" => $_SERVER["DOCUMENT_ROOT"]
);

function getConfig() {
    global $config;
    return $config;
}

?>