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
            <a href="/public/index.php"> ЛВС 319Б</a>
        </div>
            <a href="/public/index.php"> Дашборд</a>
            <a href="/public/inventory/inventory.php"> Сетевые точки</a>
            <a href="/public/report/report.php"> Экспорт отчета</a>
<a href="/public/defects/defects.php">️ Дефекты</a>
            <a href="/public/materials/materials.php"> Материалы</a>
            <?php if (function_exists('isAdmin') && isAdmin()): ?>
                <a href="/public/users/users.php"> Пользователи</a>
                <a href="/public/logs/logs.php"> Логи</a>
            <?php endif; ?>
            <a href="/public/auth/logout.php"> Выйти</a>
        </div>
    </div>
</nav>
<main>
