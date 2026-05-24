<?php
require_once '../config/db.php';

if (!isset($_SESSION['user_login']) || $_SESSION['user_login'] !== 'Admin') {
    die('Доступ запрещен');
}

if (isset($_POST['upd'])) {
    $aid = $_POST['aid'];
    $st = $_POST['status'];
    mysqli_query($db, "UPDATE " . ENTITY_TABLE . " SET status='$st' WHERE id=$aid");
}

$res = mysqli_query($db, "SELECT a.*, u.fio FROM " . ENTITY_TABLE . " a JOIN users u ON a.user_id = u.id ORDER BY a.id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Админ-панель</title>
</head>
<body>
    <header><h2>Админ-панель: <?= ENTITY_NAME_PLURAL ?></h2></header>
    <div class="nav"><a href="index.php">Выход</a></div>
    <div class="container" style="width: 900px;">
        <table>
            <tr>
                <?php foreach (ADMIN_COLUMNS as $label): ?>
                    <th><?= $label ?></th>
                <?php endforeach; ?>
                <th>Действие</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($res)): ?>
            <tr>
                <?php foreach (array_keys(ADMIN_COLUMNS) as $field): ?>
                    <td><?= htmlspecialchars($row[$field] ?? '') ?></td>
                <?php endforeach; ?>
                <td>
                    <form method="POST">
                        <input type="hidden" name="aid" value="<?= $row['id'] ?>">
                        <select name="status">
                            <?php foreach (STATUSES as $status): ?>
                                <option <?= $row['status'] == $status ? 'selected' : '' ?>><?= $status ?></option>
                            <?php endforeach; ?>
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