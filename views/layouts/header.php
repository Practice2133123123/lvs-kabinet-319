<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>ЛВС кабинет 319Б</title>
    <link rel="stylesheet" href="/assets/main.css">
</head>
<body>
<nav>
<<<<<<< HEAD
    <a href="http://lvs-kabinet-319/public/index.php">Дашборд</a>
    <a href="http://lvs-kabinet-319/public/inventory.php">Сетевые точки</a>
    <a href="http://lvs-kabinet-319/public/defects.php">Дефекты</a>
    <a href="http://lvs-kabinet-319/public/materials.php">Журнал расходов</a>
    <a href="http://lvs-kabinet-319/public/point_add.php">Добавить точку</a>
    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
        <a href="users.php"> Пользователи</a>
        <a href="logs.php"> Логи</a>
    <?php endif; ?>
    <a href="http://lvs-kabinet-319/public/logout.php">Выйти</a>
=======
    <div class="nav-container">
        <div class="nav-brand">
            <a href="http://localhost/lvs/public/index.php"> ЛВС 319Б</a>
        </div>
        <div class="nav-links">
            <a href="http://localhost/lvs/public/index.php"> Дашборд</a>
            <a href="http://localhost/lvs/public/inventory.php"> Сетевые точки</a>
            <a href="http://localhost/lvs/public/defects.php">️ Дефекты</a>
            <a href="http://localhost/lvs/public/materials.php"> Материалы</a>
            <?php if (function_exists('isAdmin') && isAdmin()): ?>
                <a href="http://localhost/lvs/public/users.php"> Пользователи</a>
                <a href="http://localhost/lvs/public/logs.php"> Логи</a>
            <?php endif; ?>
            <a href="http://localhost/lvs/public/logout.php"> Выйти</a>
        </div>
    </div>
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0
</nav>
<main>