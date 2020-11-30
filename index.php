<?php
//Import
require("src/conf.php");
require("src/db.php");
require("src/navigator.php");
require("src/contentmanager.php");

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <!-- CSS -->
    
    <link rel="stylesheet" href="res/css/bootstrap.css">
    <link rel="stylesheet" href="res/css/bootstrap-grid.css">
    <link rel="stylesheet" href="res/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="res/css/main.css">

    <!-- JS -->
    <script src="res/js/jquery.js"></script>
    <script src="res/js/main.js"></script>
    <script src="res/js/bootstrap.bundle.js"></script>
    <script src="res/js/navigator.js"></script>
</head>
<?php

$nav = new Navigator();

?>
<body>
    <div id="header" class='text-center'>
        <h1>Cégnév</h1>
    </div>
    <div id="container">
        <?php
        $nav->navbar();
        $contentManager = new ContentManager();

        ?>
    </div>
    <div id="footer" class="text-center">
        <?php echo date("Y") . "@Cégnév" ?>
    </div>
</body>
</html>