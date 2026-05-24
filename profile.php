<?php
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$uid = $_SESSION['user_id'];

if (isset($_POST['rev'])) {
    $aid = $_POST['aid'];
    $txt = $_POST['review'];
    mysqli_query($db, "UPDATE applications SET review='$txt' WHERE id=$aid AND user_id=$uid");
}

$apps = mysqli_query($db, "SELECT * FROM applications WHERE user_id=$uid ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Мои заявки</title>
</head>
<body>
    <header><h2>Мои заявки: <?= $_SESSION['user_fio'] ?></h2></header>
    <div class="nav">
        <a href="add.php">+ Подать заявку</a> |
        <a href="index.php">Выход</a>
    </div>
    <div class="container" style="width: 800px;">
        <table>
            <tr><th>Курс</th><th>Дата</th><th>Статус</th><th>Отзыв</th></tr>
            <?php while ($row = mysqli_fetch_assoc($apps)): ?>
            <tr>
                <td><?= htmlspecialchars($row['course_name']) ?></td>
                <td><?= htmlspecialchars($row['start_date']) ?></td>
                <td><b><?= htmlspecialchars($row['status']) ?></b></td>
                <td>
                    <form method="POST" style="margin:0">
                        <input type="hidden" name="aid" value="<?= $row['id'] ?>">
                        <input name="review" value="<?= htmlspecialchars($row['review'] ?? '') ?>" placeholder="Ваш отзыв">
                        <button name="rev">Ок</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>