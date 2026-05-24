<?php
require_once '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$uid = $_SESSION['user_id'];

if (isset($_POST['rev'])) {
    $aid = $_POST['aid'];
    $txt = $_POST['review'];
    mysqli_query($db, "UPDATE " . ENTITY_TABLE . " SET review='$txt' WHERE id=$aid AND user_id=$uid");
}

$apps = mysqli_query($db, "SELECT * FROM " . ENTITY_TABLE . " WHERE user_id=$uid ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Мои <?= ENTITY_NAME_PLURAL ?></title>
</head>
<body>
    <header><h2>Мои <?= ENTITY_NAME_PLURAL ?>: <?= $_SESSION['user_fio'] ?></h2></header>
    <div class="nav">
        <a href="add.php">+ Добавить <?= ENTITY_NAME ?></a> |
        <a href="index.php">Выход</a>
    </div>
    <div class="container" style="width: 800px;">
        <table>
            <tr>
                <?php foreach (PROFILE_COLUMNS as $label): ?>
                    <th><?= $label ?></th>
                <?php endforeach; ?>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($apps)): ?>
            <tr>
                <?php foreach (array_keys(PROFILE_COLUMNS) as $field): ?>
                    <td>
                        <?php if ($field === 'review'): ?>
                            <form method="POST" style="margin:0">
                                <input type="hidden" name="aid" value="<?= $row['id'] ?>">
                                <input name="review" value="<?= htmlspecialchars($row[$field] ?? '') ?>" placeholder="Отзыв">
                                <button name="rev">Ок</button>
                            </form>
                        <?php else: ?>
                            <?= htmlspecialchars($row[$field] ?? '') ?>
                        <?php endif; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>