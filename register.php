<?php
require_once 'db.php';

if (isset($_POST['register'])) {
    $l = $_POST['login'];
    $p = $_POST['pass'];
    $f = $_POST['full_name'];
    $b = $_POST['birth'];
    $t = $_POST['tel'];
    $e = $_POST['email'];

    mysqli_query($db, "INSERT INTO users (login, password, full_name, birthdate, phone, email) VALUES ('$l', '$p', '$f', '$b', '$t', '$e')");
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./assets/style.css">
    <title>Регистрация</title>
</head>
<body>
    <header><h1>Водить<span>.РФ</span></h1></header>
    <div class="container">
        <h2>Регистрация</h2>
        <form method="POST">
            <input name="login" placeholder="Логин (лат+цифры, от 6)" pattern="[A-Za-z0-9]{6,}" required>
            <input name="pass" type="password" placeholder="Пароль (от 8 символов)" minlength="8" required>
            <input name="full_name" placeholder="ФИО" required>
            <input name="birth" type="date" placeholder="Дата рождения" required>
            <input name="tel" placeholder="Телефон" required>
            <input name="email" type="email" placeholder="E-mail" required>
            <button name="register">Зарегистрироваться</button>
        </form>
        <br>
        <a href="login.php">Уже есть аккаунт? Войти</a>
    </div>
</body>
</html>