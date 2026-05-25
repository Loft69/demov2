<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./assets/style.css">
    <title>Водить.РФ</title>
</head>
<body>
    <header><h1>Водить<span>.РФ</span></h1><p>Курсы вождения водного транспорта</p></header>
    <div class="nav">
        <a href="login.php"><button style="width:auto;padding:8px 24px">Войти</button></a>
        <a href="register.php">Регистрация</a>
    </div>
    <div class="cards">
        <div class="card">
            <img src="./assets/boat.png" alt="Катер">
            <b>Катер</b>
            <p>Курс управления моторным катером для начинающих.</p>
        </div>
        <div class="card">
            <img src="./assets/yacht.jpg" alt="Яхта">
            <b>Яхта</b>
            <p>Парусное и моторное управление по международным стандартам.</p>
        </div>
        <div class="card">
            <img src="./assets/cruise.jpg" alt="Круизный лайнер">
            <b>Круизный лайнер</b>
            <p>Профессиональный курс для большого речного флота.</p>
        </div>
    </div>
    <script>alert('Добро пожаловать на портал Водить.РФ!');</script>
</body>
</html>