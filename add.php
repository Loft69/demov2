<?php
require_once '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['go'])) {
    $uid = $_SESSION['user_id'];
    
    $fields = ['user_id'];
    $values = [$uid];
    
    foreach (FORM_FIELDS as $field) {
        $name = $field[0];
        if (isset($_POST[$name]) && $_POST[$name] !== '') {
            $fields[] = $name;
            $values[] = "'" . mysqli_real_escape_string($db, $_POST[$name]) . "'";
        }
    }
    
    $sql = "INSERT INTO " . ENTITY_TABLE . " (" . implode(', ', $fields) . ") 
            VALUES (" . implode(', ', $values) . ")";
    
    mysqli_query($db, $sql);
    header('Location: profile.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Новая <?= ENTITY_NAME ?></title>
</head>
<body>
    <div class="container">
        <h2>Новая <?= ENTITY_NAME ?></h2>
        <form method="POST">
            <?php foreach (FORM_FIELDS as $field): 
                $name = $field[0];
                $type = $field[1];
                $label = $field[2];
                $options = $field[3];
            ?>
                <?php if ($type === 'select'): ?>
                    <select name="<?= $name ?>" required>
                        <option value="">-- Выберите --</option>
                        <?php foreach ($options as $opt): ?>
                            <option value="<?= htmlspecialchars($opt) ?>"><?= htmlspecialchars($opt) ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else: ?>
                    <input type="<?= $type ?>" name="<?= $name ?>" placeholder="<?= $label ?>" required>
                <?php endif; ?>
            <?php endforeach; ?>
            <button name="go">Отправить</button>
        </form>
        <a href="profile.php">← Назад</a>
    </div>
</body>
</html>