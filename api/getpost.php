<?php

require("../src/conf.php");
require("../src/class.importmanager.php");
require("../src/db/class.database.php");
require("../src/db/class.apidatabase.php");

class SoapTest {
    public function getPostById($id) {
        return APIDatabase::getPostById($id);
    }
}

$options = array("uri" => "http://localhost");
$server = new SoapServer(null, $options);
$server->setClass("SoapTest");
$server->handle();

?>