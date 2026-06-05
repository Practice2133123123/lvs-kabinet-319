<?php
require_once __DIR__ . '/../models/PointModel.php';
require_once __DIR__ . '/../models/FilterModel.php';

$totalActive = $pdo->query("SELECT COUNT(*) FROM network_points WHERE status = 'active'")->fetchColumn();
$totalDefect = $pdo->query("SELECT COUNT(*) FROM network_points WHERE status = 'defect'")->fetchColumn();
$totalDecommissioned = $pdo->query("SELECT COUNT(*) FROM network_points WHERE status = 'decommissioned'")->fetchColumn();

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$type = $_GET['type'] ?? '';
$status = $_GET['status'] ?? '';

if (!empty($type) || !empty($status)) {
    $points = filterPoints($pdo, $type, $status);
    $totalPages = 1;
    $currentPage = 1;
} else {
    $total = countAllPoints($pdo);
    $totalPages = ceil($total / $limit);
    if ($page > $totalPages && $totalPages > 0) $page = $totalPages;
    $offset = ($page - 1) * $limit;
    $points = getPointsWithPagination($pdo, $limit, $offset);
    $currentPage = $page;
}
?>