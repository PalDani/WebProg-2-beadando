<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Belépés</h2>
                <form method="post">
                    <input type="hidden" name="auth_type" id="auth_type" value="log">
                    <input type="text" placeholder="Felhasználónév/E-mail" name="username" id="username" required>
                    <input type="password" placeholder="Jelszó" name="password" id="password" required>
                    <input type="submit" value="Belépés">
                </form>
            </div>
            <div class="col">
                <h2>Belépés</h2>
                <form method="post">
                    <input type="hidden" name="auth_type" id="auth_type" value="reg">
                    <input type="text" placeholder="Felhasználónév" name="username" id="username" required>
                    <input type="email" placeholder="E-mail" required name="email" id="email">
                    <input type="password" placeholder="Jelszó" name="password" id="password" required>
                    <input type="password" placeholder="Jelszó mégegyszer" name="password_again" id="password_again" required>
                    <input type="submit" value="Regisztráció">
                </form>
            </div>
        </div>
    </div>
</body>
</html>