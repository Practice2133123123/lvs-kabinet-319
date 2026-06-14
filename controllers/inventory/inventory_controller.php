<?php
require_once __DIR__ . '/../../models/inventory/PointModel.php';
require_once __DIR__ . '/../../includes/pagination.php';
require_once __DIR__ . '/../../includes/helpers.php';

// Получаем подсчёты по статусам
$statusCounts = getPointStatusCounts($pdo);
$totalActive = $statusCounts['active'] ?? 0;
$totalDefect = $statusCounts['defect'] ?? 0;
$totalDecommissioned = $statusCounts['decommissioned'] ?? 0;

// Пагинация
$limit = 5;
$page = getGetParam('page', 'int', 1);

$type = getGetParam('type', 'string');
$status = getGetParam('status', 'string');

// if (!empty($type) || !empty($status)) {
//     // Если есть фильтры, получаем отфильтрованные точки
//     $points = filterPoints($pdo, $type, $status);
//     $totalPages = 1;
//     $currentPage = 1;
// } else {
    // Если фильтров нет, получаем все точки с пагинацией
    $total = countAllPoints($pdo, $status, $type);
    $pagination = getPaginationInfo($total, $limit, $page);

    $points = getPointsWithPagination($pdo, $pagination['limit'], $pagination['offset'], $type, $status);
    $currentPage = $pagination['current_page'];
    $totalPages = $pagination['total_pages'];
// }
?>