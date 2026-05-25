<?php
require_once 'db.php';

if (!isset($_SESSION['user_login']) || $_SESSION['user_login'] !== 'Admin26') {
    die('Доступ запрещён');
}

if (isset($_POST['update-status'])) {
    $aid = (int)$_POST['aid'];
    $st  = mysqli_real_escape_string($db, $_POST['status']);
    mysqli_query($db, "UPDATE applications SET status='$st' WHERE id=$aid");
}

$res = mysqli_query($db, "SELECT a.*, u.full_name, u.phone FROM applications a
                           JOIN users u ON a.user_id = u.id ORDER BY a.id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./assets/style.css">
    <title>Администратор</title>
</head>
<body>
    <header><h1>Водить<span>.РФ</span></h1><h2>Панель администратора</h2></header>
    <div class="nav"><a href="index.php">Выход</a></div>
    <div class="container" style="width:950px">
        <table class="compact-table">
            <tr><th>Пользователь</th><th>Транспорт</th><th>Статус</th><th>Отзыв</th><th>Действие</th></tr>
            <?php while ($row = mysqli_fetch_assoc($res)): ?>
            <tr>
                <td><?= htmlspecialchars($row['full_name']) ?><br><small><?= htmlspecialchars($row['phone']) ?></small></td>
                <td><?= htmlspecialchars($row['transport']) ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
                <td><?= htmlspecialchars($row['review'] ?? '—') ?></td>
                <td>
                    <form method="POST" style="display:flex;gap:6px;margin:0">
                        <input type="hidden" name="aid" value="<?= $row['id'] ?>">
                        <select name="status" style="margin:0; padding:4px;">
                            <option <?= $row['status'] == 'Новая' ? 'selected' : '' ?>>Новая</option>
                            <option <?= $row['status'] == 'Идет обучение' ? 'selected' : '' ?>>Идет обучение</option>
                            <option <?= $row['status'] == 'Обучение завершено' ? 'selected' : '' ?>>Обучение завершено</option>
                        </select>
                        <button name="update-status" class="btn-sm">Сменить</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>