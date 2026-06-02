<?php
require '../includes/auth.php';
require '../config/db.php';
require '../includes/header.php';

$stmt = $pdo->query("SELECT COUNT(*) FROM network_points");
$totalPoints = $stmt->fetchColumn();

$stmt1 = $pdo->query("SELECT COUNT(*) FROM defects WHERE status = 'open'");
$openDefects = $stmt1->fetchColumn();

$stmt2 = $pdo->query("SELECT SUM(quantity) FROM material_usage WHERE material_id IN (SELECT id FROM materials WHERE type = 'cable')");
$totalCable = $stmt2->fetchColumn() ?: 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <form>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <p class="card-text">Всего точек: <?= $totalPoints; ?></p>
            </div>
        </div>

        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <p class="card-text">Открытых дефектов: <?= $openDefects; ?></p>
            </div>
        </div>

        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <p class="card-text">Кабель (длина): <?= $totalCable; ?> м</p>
            </div>
        </div>
    </form>
</body>
</html>
