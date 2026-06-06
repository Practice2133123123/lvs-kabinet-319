<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ЛВС 319Б</title>
    <link rel="stylesheet" href="http://localhost/lvs/assets/main.css">
</head>
<body>
<nav>
    <div class="nav-container">
        <div class="nav-brand">
            <a href="http://localhost/lvs/public/index.php">ЛВС 319Б</a>
        </div>
        <div class="nav-links">
            <a href="http://localhost/lvs/public/dashboard/index.php">Дашборд</a>
            <a href="http://localhost/lvs/public/inventory/inventory.php">Сетевые точки</a>
            <a href="http://localhost/lvs/public/defects/defects.php">Дефекты</a>
            <a href="http://localhost/lvs/public/materials/materials.php">Материалы</a>
            <?php if (function_exists('isAdmin') && isAdmin()): ?>
                <a href="http://localhost/lvs/public/users/users.php">Пользователи</a>
                <a href="http://localhost/lvs/public/logs/logs.php">Логи</a>
            <?php endif; ?>
            <a href="http://localhost/lvs/public/auth/logout.php">Выйти</a>
        </div>
    </div>
</nav>
<main>