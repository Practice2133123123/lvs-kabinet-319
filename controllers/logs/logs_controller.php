<?php
require_once __DIR__ . '/../../models/logs/LogModel.php';
require_once __DIR__ . '/../../models/auth/UserModel.php';
require_once __DIR__ . '/../../includes/helpers.php';
require_once __DIR__ . '/../../includes/pagination.php';

$user_id = getGetParam('user_id', 'int');
$action = getGetParam('action', 'string');
$date_from = getGetParam('date_from', 'date');
$date_to = getGetParam('date_to', 'date');

$logs = getFilteredLogs($pdo, $user_id, $action, $date_from, $date_to);
$users = getAllUsers($pdo);

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$type = $_GET['type'] ?? '';
$status = $_GET['status'] ?? '';

// if (!empty($type) || !empty($status)) {
//     $logs = getFilteredLogs($pdo, $user_id, $action, $date_from, $date_to);
//     $totalPages = 1;
//     $currentPage = 1;
// } else {
    $total = countAllLogs($pdo);
    $pagination = getPaginationInfo($total, $limit, $page);
    
    $logs = getlogsWithPagination($pdo, $pagination['limit'], $pagination['offset']);
    $currentPage = $pagination['current_page'];
    $totalPages = $pagination['total_pages'];
// }
?>