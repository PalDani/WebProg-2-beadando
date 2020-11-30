<?php

$config = array(
    "database" => array(
        "host" => "127.0.0.1",
        "port" => "3306",
        "username" => "root",
        "password" => "",
        "db_name" => "webprog2_beadando",
        "charset" => "utf8"
    )
);

function getConfig() {
    global $config;
    return $config;
}

?>