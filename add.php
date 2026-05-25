<?php
require_once 'db.php';

if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }

if (isset($_POST['send'])) {
    $uid = $_SESSION['user_id'];
    $tr  = $_POST['transport'];
    $sd  = $_POST['date'];
    $pm  = $_POST['pay'];

    mysqli_query($db, "INSERT INTO applications (user_id, transport, start_date, payment) VALUES ($uid, '$tr', '$sd', '$pm')");
    header('Location: profile.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./assets/style.css">
    <title>Новая заявка</title>
</head>
<body>
    <header><h1>Водить<span>.РФ</span></h1></header>
    <div class="container">
        <h2>Новая заявка</h2>
        <form method="POST">
            <select name="transport" required>
                <option value="">-- Вид транспорта --</option>
                <option>Катер</option>
                <option>Яхта</option>
                <option>Круизный лайнер</option>
            </select>
            <input name="date" type="date" required>
            <select name="pay" required>
                <option value="">-- Способ оплаты --</option>
                <option>Наличные</option>
                <option>Карта</option>
                <option>Рассрочка</option>
            </select>
            <button name="send">Отправить</button>
        </form>
        <br>
        <a href="profile.php">← Назад</a>
    </div>
</body>
</html>