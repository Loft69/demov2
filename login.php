<?php
require_once 'db.php';

if (isset($_POST['login-try'])) {
    $l = $_POST['login'];
    $p = $_POST['pass'];

    $res  = mysqli_query($db, "SELECT * FROM users WHERE login='$l' AND password='$p'");
    $user = mysqli_fetch_assoc($res);

    if ($user) {
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['user_full_name'] = $user['full_name'];
        $_SESSION['user_login'] = $user['login'];

        if ($l === 'Admin26') header('Location: admin.php');
        else header('Location: profile.php');
        exit;
    } else {
        echo "<script>alert('Неверный логин или пароль');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./assets/style.css">
    <title>Вход</title>
</head>
<body>
    <header><h1>Водить<span>.РФ</span></h1></header>
    <div class="container">
        <h2>Вход</h2>
        <form method="POST">
            <input name="login" placeholder="Логин" required>
            <input name="pass" type="password" placeholder="Пароль" required>
            <button name="login-try">Войти</button>
        </form>
        <br>
        <a href="register.php">Регистрация</a>
    </div>
</body>
</html>