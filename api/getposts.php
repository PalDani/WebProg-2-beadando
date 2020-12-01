<?php
Header("Access-Control-Allow-Origin: *");
Header("Content-Type: application/json; charset=UTF-8");
Header("Access-Control-Allow-Methods: POST");
Header("Access-Control-Max-Age: 3600");
Header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require("../src/conf.php");
require("../src/class.importmanager.php");
require("../src/db/class.database.php");
require("../src/db/class.apidatabase.php");

$data = json_decode(file_get_contents("php://input"));
if(!empty($data->type)) {

    
    $res = APIDatabase::getPosts($data->type);

    if($res["result"]) {
        http_response_code(201);
        echo json_encode($res);
    } else {
        http_response_code(503);
        echo json_encode($res);
    }
    
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Hiányzó adatok!"));
}

?>