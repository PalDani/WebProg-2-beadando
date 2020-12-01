<?php
ImportManager::load("src/db/class.authdatabase.php");
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php

if(isset($_POST["auth_type"])) {
    if($_POST["auth_type"] == "log") {
        if(AuthDatabase::userLogin($_POST["username"], $_POST["password"])) {
            echo '<div class="alert alert-success" role="alert">Sikeres belépés!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Sikertelen belépés!</div>';
        }
    } else if($_POST["auth_type"] == "reg") {
        if(AuthDatabase::userRegister($_POST["rusername"], $_POST["remail"], $_POST["rpassword"], $_POST["rpassword_again"])) {
            echo '<div class="alert alert-success" role="alert">Sikeres regisztráció! Most már beléphet!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Sikertelen regisztráció!</div>';
        }
    } else {
        //Hiba
    }
}

if(!isset($_SESSION["user_data"])) {
    echo '<div class="container">
    <div class="row">
        <div class="col d-flex flex-row justify-content-md-center border">
        <div class="p-2 text-center"><h2>Belépés</h2></div>
            <form method="post">
                <input type="hidden" name="auth_type" id="auth_type" value="log">
                <div class="p-2"><input type="text" placeholder="Felhasználónév/E-mail" name="username" id="username" required></div>
                <div class="p-2"><input type="password" placeholder="Jelszó" name="password" id="password" required></div>
                <div class="p-2"><input type="submit" value="Belépés"></div>
            </form>
        </div>
        <div class="col d-flex flex-row justify-content-md-center border">
        <div class="p-2 text-center"><h2>Regisztráció</h2></div>
            <form method="post" onsubmit="return rpassword.value == rpassword_again.value;">
                <input type="hidden" name="auth_type" id="auth_type" value="reg">
                <div class="p-2"><input type="text" placeholder="Felhasználónév" name="rusername" id="rusername" required></div>
                <div class="p-2"><input type="email" placeholder="E-mail" required name="remail" id="remail"></div>
                <div class="p-2"><input type="password" placeholder="Jelszó" name="rpassword" id="rpassword" required></div>
                <div class="p-2"><input type="password" placeholder="Jelszó mégegyszer" name="rpassword_again" id="rpassword_again" required></div>
                <div class="p-2"><input type="submit" value="Regisztráció"></div>
            </form>
        </div>
    </div>
</div>';
} else {
    echo '<div class="alert alert-info" role="alert">Ön már be van lépve! (<a href="session_destroy.php">Kilépés</a>)</div>';
}

?>
    
</body>
</html>