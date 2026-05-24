<?php
// config/db.php

// ===== НАСТРОЙКИ БД =====
$host = 'localhost';
$dbname = 'korochki_db';
$user = 'root';
$pass = '';

$db = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($db, 'utf8');

session_start();

// ===== НАСТРОЙКИ ПРЕДМЕТНОЙ ОБЛАСТИ (МЕНЯЙТЕ ЗДЕСЬ) =====
define('SITE_NAME', 'Корочки.есть');
define('SITE_TAGLINE', 'Получи профессиональное образование онлайн!');
define('ENTITY_NAME', 'заявка');
define('ENTITY_NAME_PLURAL', 'заявки');
define('ENTITY_TABLE', 'applications');

// Поля для формы добавления: [название, тип, лейбл, опции для select]
define('FORM_FIELDS', [
    ['course_name', 'text', 'Название курса', []],
    ['start_date', 'date', 'Дата начала', []],
    ['payment_method', 'select', 'Способ оплаты', ['Наличными', 'Картой', 'Переводом']]
]);

// Колонки в таблице профиля
define('PROFILE_COLUMNS', [
    'course_name' => 'Курс',
    'start_date' => 'Дата',
    'status' => 'Статус',
    'review' => 'Отзыв'
]);

// Колонки в админ-таблице
define('ADMIN_COLUMNS', [
    'fio' => 'Студент',
    'course_name' => 'Курс',
    'status' => 'Статус'
]);

// Возможные статусы
define('STATUSES', ['Новая', 'Идет обучение', 'Обучение завершено']);
?>