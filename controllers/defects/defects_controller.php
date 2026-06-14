<?php
require_once __DIR__ . '/../../models/defects/DefectModel.php';
require_once __DIR__ . '/../../includes/pagination.php';
require_once __DIR__ . '/../../includes/helpers.php';

// Получаем подсчёты по статусам
$statusCounts = getDefectStatusCounts($pdo);
$totalOpen = $statusCounts['open'] ?? 0;
$totalInProgress = $statusCounts['in_progress'] ?? 0;
$totalClosed = $statusCounts['closed'] ?? 0;

// Обработка пагинации
$limit = 5;
$page = getGetParam('page', 'int', 1);

$severity = getGetParam('severity', 'string');
$status = getGetParam('status', 'string');

// if (!empty($severity) || !empty($status)) {
//     $defects= getAllDefects($pdo, $severity, $status);
//     $totalPages = 1;
//     $currentPage = 1;
// } else{
$total = countAllDefects($pdo, $severity, $status);
$pagination = getPaginationInfo($total, $limit, $page);
$defects = getDefectsWithPagination($pdo, $pagination['limit'], $pagination['offset'], $status, $severity);
$currentPage = $pagination['current_page'];
$totalPages = $pagination['total_pages'];
// }
?>