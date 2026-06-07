<?php
require_once __DIR__ . '/../../models/defects/DefectModel.php';
require_once __DIR__ . '/../../includes/pagination.php';

// Получаем подсчёты по статусам
$statusCounts = getDefectStatusCounts($pdo);
$totalOpen = $statusCounts['open'] ?? 0;
$totalInProgress = $statusCounts['in_progress'] ?? 0;
$totalClosed = $statusCounts['closed'] ?? 0;

// Обработка пагинации
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$total = countAllDefects($pdo);
$pagination = getPaginationInfo($total, $limit, $page);

$defects = getDefectsWithPagination($pdo, $pagination['limit'], $pagination['offset']);
$currentPage = $pagination['current_page'];
$totalPages = $pagination['total_pages'];
?>