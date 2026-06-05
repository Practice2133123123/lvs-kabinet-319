<?php
require_once __DIR__ . '/../models/PointModel.php';

require_once __DIR__ . '/../models/FilterModel.php';

$type = $_GET['type'] ?? '';
$status = $_GET['status'] ?? '';

if (!empty($type) || !empty($status)) {
    $points = filterPoints($pdo, $type, $status);
} else {
    $points = getAllPoints($pdo);
}


