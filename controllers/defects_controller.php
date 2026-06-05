<?php
require_once __DIR__ . '/../models/DefectModel.php';

$totalOpen = $pdo->query("SELECT COUNT(*) FROM defects WHERE status = 'open'")->fetchColumn();
$totalInProgress = $pdo->query("SELECT COUNT(*) FROM defects WHERE status = 'in_progress'")->fetchColumn();
$totalClosed = $pdo->query("SELECT COUNT(*) FROM defects WHERE status = 'closed'")->fetchColumn();

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$total = countAllDefects($pdo);
$totalPages = ceil($total / $limit);
if ($page > $totalPages && $totalPages > 0) $page = $totalPages;
$offset = ($page - 1) * $limit;

$defects = getDefectsWithPagination($pdo, $limit, $offset);
$currentPage = $page;
?>