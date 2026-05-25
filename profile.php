<?php
require_once 'db.php';

if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }

$uid = $_SESSION['user_id'];

if (isset($_POST['rev'])) {
    $aid = (int)$_POST['aid'];
    $txt = mysqli_real_escape_string($db, $_POST['review']);
    mysqli_query($db, "UPDATE applications SET review='$txt' WHERE id=$aid AND user_id=$uid");
}

$apps = mysqli_query($db, "SELECT * FROM applications WHERE user_id=$uid ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./assets/style.css">
    <title>Мои заявки</title>
</head>
<body>
    <header><h1>Водить<span>.РФ</span></h1><h2>Мои заявки: <?= htmlspecialchars($_SESSION['user_full_name']) ?></h2></header>
    <div class="nav">
        <a href="add.php">+ Подать заявку</a> |
        <a href="index.php">Выход</a>
    </div>
    <div class="container" style="width:850px">
        <table class="compact-table">
            <tr><th>Транспорт</th><th>Дата начала</th><th>Оплата</th><th>Статус</th><th>Отзыв</th></tr>
            <?php while ($row = mysqli_fetch_assoc($apps)): ?>
            <tr>
                <td><?= htmlspecialchars($row['transport']) ?></td>
                <td><?= htmlspecialchars($row['start_date']) ?></td>
                <td><?= htmlspecialchars($row['payment']) ?></td>
                <td><b><?= htmlspecialchars($row['status']) ?></b></td>
                <td>
                    <?php if ($row['status'] === 'Обучение завершено'): ?>
                    <form method="POST" style="margin:0;display:flex;gap:6px">
                        <input type="hidden" name="aid" value="<?= $row['id'] ?>">
                        <input name="review" value="<?= htmlspecialchars($row['review'] ?? '') ?>" placeholder="Ваш отзыв" style="margin:0; padding:4px;">
                        <button name="rev" class="btn-sm">Ок</button>
                    </form>
                    <?php else: ?>
                    <span style="color:#999; font-size:12px;">Доступно после завершения</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>