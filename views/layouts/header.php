<?php require_once __DIR__ . "/../../includes/auth.php";?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ЛВС 319Б</title>
    <link rel="stylesheet" href="/assets/main.css">
    <script>
    function toggleFilter(id) { var el = document.getElementById(id); if (el) el.classList.toggle('hidden'); }
    document.addEventListener('DOMContentLoaded', function() {
        var path = window.location.pathname;
        document.querySelectorAll('.nav-menu a:not(.nav-logout)').forEach(function(a) {
            if (path.startsWith(a.getAttribute('href'))) a.classList.add('active');
        });
    });
    </script>
</head>
<body>

<nav class="nav-menu">
    <span class="nav-brand">ЛВС 319Б</span>
    <a href="/public/dashboard/index.php">Дашборд</a>
    <a href="/public/inventory/inventory.php">Сетевые точки</a>
    <?php if (isLoggedIn()):?>
        <a href="/public/defects/defects.php">Дефекты</a>
        <a href="/public/materials/materials.php">Материалы</a>
        <a href="/public/report/report.php">Отчеты</a>
    <?php else:?>
        <a href="/public/auth/login.php">Войти</a>
    <?php endif;?>
    <?php if (function_exists('isAdmin') && isAdmin()): ?>
        <a href="/public/users/users.php">Пользователи</a>
        <a href="/public/logs/logs.php">Логи</a>
    <?php endif; ?>
    <a href="/public/auth/logout.php" class="nav-logout">Выйти</a>
</nav>

<div class="container">
