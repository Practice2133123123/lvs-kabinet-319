<?php

require_once __DIR__ . '/../models/FilterModel.php';

$date_from = $_GET['date_from'] ?? '';
$date_to = $_GET['date_to'] ?? '';
$material_id = $_GET['material_id'] ?? '';

$items = filterMaterials($pdo, $date_from, $date_to, $material_id);
$materialsList = getMaterialsList($pdo);

// Подсчёт сводки
$total_cable = 0;
$total_connectors = 0;
$total_sockets = 0;

foreach ($items as $item) {
    switch ($item['material_type']) {
        case 'cable':
            $total_cable += $item['quantity'];
            break;
        case 'connector':
            $total_connectors += $item['quantity'];
            break;
        case 'socket':
            $total_sockets += $item['quantity'];
            break;
    }
}
?>


