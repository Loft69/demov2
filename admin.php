<?php
require_once 'db.php';

if (!isset($_SESSION['user_login']) || $_SESSION['user_login'] !== 'Admin') {
    die('Доступ запрещен');
}

if (isset($_POST['upd'])) {
    $aid = $_POST['aid'];
    $st = $_POST['status'];
    mysqli_query($db, "UPDATE applications SET status='$st' WHERE id=$aid");
}

$res = mysqli_query($db, "SELECT a.*, u.fio FROM applications a JOIN users u ON a.user_id = u.id ORDER BY a.id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Панель администратора</title>
</head>
<body>
    <header><h2>Панель администратора</h2></header>
    <div class="nav"><a href="index.php">Выход</a></div>
    <div class="container" style="width: 900px;">
        <table>
            <tr><th>Студент</th><th>Курс</th><th>Статус</th><th>Действие</th></tr>
            <?php while ($row = mysqli_fetch_assoc($res)): ?>
            <tr>
                <td><?= htmlspecialchars($row['fio']) ?></td>
                <td><?= htmlspecialchars($row['course_name']) ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="aid" value="<?= $row['id'] ?>">
                        <select name="status">
                            <option <?= $row['status'] == 'Новая' ? 'selected' : '' ?>>Новая</option>
                            <option <?= $row['status'] == 'Идет обучение' ? 'selected' : '' ?>>Идет обучение</option>
                            <option <?= $row['status'] == 'Обучение завершено' ? 'selected' : '' ?>>Обучение завершено</option>
                        </select>
                        <button name="upd">Сменить</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>