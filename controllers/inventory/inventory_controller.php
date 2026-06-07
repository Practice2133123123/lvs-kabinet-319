<?php
require_once __DIR__ . '/../../models/inventory/PointModel.php';
require_once __DIR__ . '/../../models/materials/FilterModel.php';
require_once __DIR__ . '/../../includes/pagination.php';

// Получаем подсчёты по статусам
$statusCounts = getPointStatusCounts($pdo);
$totalActive = $statusCounts['active'] ?? 0;
$totalDefect = $statusCounts['defect'] ?? 0;
$totalDecommissioned = $statusCounts['decommissioned'] ?? 0;

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$type = $_GET['type'] ?? '';
$status = $_GET['status'] ?? '';

if (!empty($type) || !empty($status)) {
    $points = filterPoints($pdo, $type, $status);
    $totalPages = 1;
    $currentPage = 1;
} else {
    $total = countAllPoints($pdo);
    $pagination = getPaginationInfo($total, $limit, $page);
    
    $points = getPointsWithPagination($pdo, $pagination['limit'], $pagination['offset']);
    $currentPage = $pagination['current_page'];
    $totalPages = $pagination['total_pages'];
}
?>