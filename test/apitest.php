<?php

require("../src/conf.php");
require("../src/class.importmanager.php");
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Teszt</title>
</head>
<body>
    <form method="POST">
        <input type="submit" name="soap" id="soap" value="SOAP">
        <input type="submit" name="rest" id="rest" value="REST">
    </form>
</body>
</html>
<?php
if(isset($_POST["soap"])) {
    echo "<hr>";
    $client = new SoapClient(null, array("uri" => "http://localhost/", "location" => "http://localhost/api/getpost.php", "trace" => 1));
    $client->getPostById(1);
    var_dump($client->__soapCall("getPostById", array("id" => 1)));
    } else if(isset($_POST["rest"])) {
    echo "<hr>";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array("type" => 1)));
    curl_setopt($curl, CURLOPT_URL, "http://localhost/api/getposts.php");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $result = curl_exec($curl);
    curl_close($curl);
    echo $result;
    }

?>