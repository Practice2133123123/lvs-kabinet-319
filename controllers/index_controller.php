<?php
require_once __DIR__ . '/../models/DashboardModel.php';

$totalPoints = getTotalPoints($pdo);
$openDefects = getOpenDefects($pdo);
$totalCable = getTotalCable($pdo);
?>