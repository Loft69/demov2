<?php require_once '../config/db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title><?= SITE_NAME ?></title>
</head>
<body>
    <header><h1><?= SITE_NAME ?></h1></header>
    <div class="container" style="text-align: center;">
        <h2><?= SITE_TAGLINE ?></h2>
        <div class="nav">
            <a href="login.php"><button>Войти</button></a>
            <br><br>
            <a href="register.php">Регистрация</a>
        </div>
    </div>
</body>
</html>