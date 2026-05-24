<?php
require_once '../config/db.php';

if (isset($_POST['go'])) {
    $l = $_POST['login'];
    $p = $_POST['pass'];
    
    $res = mysqli_query($db, "SELECT * FROM users WHERE login='$l' AND password='$p'");
    $user = mysqli_fetch_assoc($res);
    
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_login'] = $user['login'];
        $_SESSION['user_fio'] = $user['fio'];
        
        if ($l == 'Admin') header('Location: admin.php');
        else header('Location: profile.php');
    } else {
        echo "<script>alert('Неверный логин или пароль');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Вход</title>
</head>
<body>
    <div class="container">
        <h2>Вход</h2>
        <form method="POST">
            <input name="login" placeholder="Логин" required>
            <input name="pass" type="password" placeholder="Пароль" required>
            <button name="go">Войти</button>
        </form>
        <a href="register.php">Регистрация</a>
    </div>
</body>
</html>