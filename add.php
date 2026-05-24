<?php
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['go'])) {
    $uid = $_SESSION['user_id'];
    $cn = $_POST['course'];
    $sd = $_POST['date'];
    $pm = $_POST['pay'];
    
    mysqli_query($db, "INSERT INTO applications (user_id, course_name, start_date, payment_method) 
                       VALUES ($uid, '$cn', '$sd', '$pm')");
    header('Location: profile.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Новая заявка</title>
</head>
<body>
    <div class="container">
        <h2>Новая заявка</h2>
        <form method="POST">
            <input name="course" placeholder="Название курса" required>
            <input name="date" type="date" required>
            <select name="pay" required>
                <option value="">-- Способ оплаты --</option>
                <option>Наличными</option>
                <option>Картой</option>
                <option>Переводом</option>
            </select>
            <button name="go">Отправить</button>
        </form>
        <a href="profile.php">← Назад</a>
    </div>
</body>
</html>