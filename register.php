<?php
require_once '../config/db.php';

if (isset($_POST['go'])) {
    $l = $_POST['login'];
    $p = $_POST['pass'];
    $f = $_POST['fio'];
    $t = $_POST['tel'];
    $e = $_POST['email'];
    
    mysqli_query($db, "INSERT INTO users (login, password, fio, phone, email) 
                       VALUES ('$l', '$p', '$f', '$t', '$e')");
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Регистрация</title>
</head>
<body>
    <div class="container">
        <h2>Регистрация</h2>
        <form method="POST">
            <input name="login" placeholder="Логин (лат+цифры, от 6)" pattern="[A-Za-z0-9]{6,}" required>
            <input name="pass" type="password" placeholder="Пароль (от 8)" minlength="8" required>
            <input name="fio" placeholder="ФИО" required>
            <input name="tel" placeholder="Телефон" required>
            <input name="email" type="email" placeholder="E-mail" required>
            <button name="go">Зарегистрироваться</button>
        </form>
        <a href="login.php">Уже есть аккаунт? Войти</a>
    </div>
</body>
</html>