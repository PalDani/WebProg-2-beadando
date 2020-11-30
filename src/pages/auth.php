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

?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-center">Belépés</h2>
                <form method="post">
                    <input type="hidden" name="auth_type" id="auth_type" value="log">
                    <input type="text" placeholder="Felhasználónév/E-mail" name="username" id="username" required>
                    <input type="password" placeholder="Jelszó" name="password" id="password" required>
                    <input type="submit" value="Belépés">
                </form>
            </div>
            <div class="col">
                <h2 class="text-center">Regisztráció</h2>
                <form method="post" onsubmit="return rpassword.value == rpassword_again.value;">
                    <input type="hidden" name="auth_type" id="auth_type" value="reg">
                    <input type="text" placeholder="Felhasználónév" name="rusername" id="rusername" required>
                    <input type="email" placeholder="E-mail" required name="remail" id="remail">
                    <input type="password" placeholder="Jelszó" name="rpassword" id="rpassword" required>
                    <input type="password" placeholder="Jelszó mégegyszer" name="rpassword_again" id="rpassword_again" required>
                    <input type="submit" value="Regisztráció">
                </form>
            </div>
        </div>
    </div>
</body>
</html>