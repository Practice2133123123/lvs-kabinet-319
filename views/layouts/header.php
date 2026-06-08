<!DOCTYPE html>
<html lang="ru">
<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>ЛВС 319Б</title>
    <link rel="stylesheet" href="/assets/main.css">
        <link rel="stylesheet" href="/assets/print.css" media="print">

</head>
<body>
<ul class="nav justify-content-center">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/public/dashboard/index.php">Дашборд</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/public/inventory/inventory.php">Сетевые точки</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/public/defects/defects.php">Дефекты</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/public/materials/materials.php">Материалы</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/public/report/report.php">Отчеты</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/public/auth/logout.php">Выйти</a>
    </li>
    <?php if (function_exists('isAdmin') && isAdmin()): ?>
    <li class="nav-item">
        <a class="nav-link" href="/public/users/users.php">Пользователи</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/public/logs/logs.php">Логи</a>
        </li>
    <?php endif; ?>
</ul>
<p style="text-align: center;">ЛВС 319Б</p>

<!--<nav class="no-print">-->
<!--    <a href="/public/dashboard/index.php">Дашборд</a>-->
<!--    <a href="/public/inventory/inventory.php">Сетевые точки</a>-->
<!--    <a href="/public/defects/defects.php">Дефекты</a>-->
<!--    <a href="/public/materials/materials.php">Материалы</a>-->
<!--    <a href="/public/report/report.php">Отчёты</a>-->
<!--    --><?php //if (function_exists('isAdmin') && isAdmin()): ?>
<!--        <a href="/public/users/users.php">Пользователи</a>-->
<!--        <a href="/public/logs/logs.php">Логи</a>-->
<!--    --><?php //endif; ?>
<!--    <a href="/public/auth/logout.php">Выйти</a>-->
<!--</nav>-->

<main>