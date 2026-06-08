<?php
require_once __DIR__ . '/../../models/materials/MaterialModel.php';
require_once __DIR__ . '/../../includes/pagination.php';
require_once __DIR__ . '/../../models/materials/FilterModel.php';

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$date_from = $_GET['date_from'] ?? '';
$date_to = $_GET['date_to'] ?? '';
$material_id = $_GET['material_id'] ?? '';

// Получаем список материалов для фильтра
$materialsList = getMaterialsList($pdo);

// Обработка пагинации
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;


$date_from = $_GET['date_from'] ?? '';
$date_to = $_GET['date_to'] ?? '';
$material_id = $_GET['material_id'] ?? '';

// if (!empty($material_id) || !empty($date_from) || !empty($date_to)) {
    // $items=filterMaterials($pdo, $date_from, $date_to, $material_id);
    // $totalPages = 1;
    // $currentPage = 1;
// }else{
// Считаем общее количество отфильтрованных записей
$total = countAllMaterialsUsage($pdo, $date_from, $date_to, $material_id);
$pagination = getPaginationInfo($total, $limit, $page);
// Получаем отфильтрованные материалы с пагинацией
$items = getMaterialsUsageWithPagination($pdo, $pagination['limit'], $pagination['offset'], $date_from, $date_to, $material_id);
$currentPage = $pagination['current_page'];
$totalPages = $pagination['total_pages'];
// }


// Подсчёт сводки по отфильтрованным данным
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