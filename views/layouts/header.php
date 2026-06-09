<?php require_once __DIR__ . "/../../includes/auth.php";?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>ЛВС 319Б</title>
    <link rel="stylesheet" href="/assets/main.css">
    <link rel="stylesheet" href="/assets/responsive.css">
</head>
<body>

<ul class="nav-menu">
    <li><a href="/public/dashboard/index.php">Дашборд</a></li>
    <li><a href="/public/inventory/inventory.php">Сетевые точки</a></li>
    <?php if (isLoggedIn()):?>
        <li><a href="/public/defects/defects.php">Дефекты</a></li>
        <li><a href="/public/materials/materials.php">Материалы</a></li>
        <li><a href="/public/report/report.php">Отчеты</a></li>
    <?php else:?>
        <li><a href="/public/auth/login.php">Войти</a></li>
    <?php endif;?>
    <?php if (function_exists('isAdmin') && isAdmin()): ?>
        <li><a href="/public/users/users.php">Пользователи</a></li>
        <li><a href="/public/logs/logs.php">Логи</a></li>
    <?php endif; ?>
    <li><a href="/public/auth/logout.php">Выйти</a></li>
</ul>

<div class="container">