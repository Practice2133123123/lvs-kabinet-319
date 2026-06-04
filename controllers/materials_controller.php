<?php
require_once __DIR__ . '/../models/MaterialModel.php';

$date_from = isset($_GET['date_from']) ? $_GET['date_from'] : '';
$date_to = isset($_GET['date_to']) ? $_GET['date_to'] : '';
$material_id = isset($_GET['material_id']) ? $_GET['material_id'] : '';

$items = getAllMaterialsUsage($pdo, $date_from, $date_to, $material_id);
$materialsList = getMaterialsList($pdo);

$total_cable = 0;
$total_connectors = 0;
$total_sockets = 0;

foreach ($items as $item) {
    $type = getMaterialTypeById($pdo, $item['material_id']);
    if ($type == 'cable') {
        $total_cable += $item['quantity'];
    } elseif ($type == 'connector') {
        $total_connectors += $item['quantity'];
    } elseif ($type == 'socket') {
        $total_sockets += $item['quantity'];
    }
}