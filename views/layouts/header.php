<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>ЛВС 319Б</title>
    <link rel="stylesheet" href="/assets/main.css">
        <link rel="stylesheet" href="/assets/print.css" media="print">

</head>
<body>

<nav class="no-print">
    <a href="/public/dashboard/index.php">Дашборд</a>
    <a href="/public/inventory/inventory.php">Сетевые точки</a>
    <a href="/public/defects/defects.php">Дефекты</a>
    <a href="/public/materials/materials.php">Материалы</a>
    <a href="/public/report/report.php">Отчёты</a>
    <?php if (function_exists('isAdmin') && isAdmin()): ?>
        <a href="/public/users/users.php">Пользователи</a>
        <a href="/public/logs/logs.php">Логи</a>
    <?php endif; ?>
    <a href="/public/auth/logout.php">Выйти</a>
</nav>

<main>