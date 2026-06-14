<?php
require_once __DIR__ . '/../../models/logs/LogModel.php';
require_once __DIR__ . '/../../models/auth/UserModel.php';
require_once __DIR__ . '/../../includes/helpers.php';
require_once __DIR__ . '/../../includes/pagination.php';

$limit = 5;
$page = getGetParam('page', 'int', 1);

$user = getGetParam('user_id', 'int');
$action = getGetParam('action', 'string');
$date_from = getGetParam('date_from', 'date');
$date_to = getGetParam('date_to', 'date');

// $logs = getFilteredLogs($pdo, $user, $action, $date_from, $date_to);
$users = getAllUsers($pdo);



// $user = $_GET['user_id'] ?? '';
// $actions = $_GET['action'] ?? '';
// $dateFrom = $_GET['date_from'] ?? '';
// $dateTo = $_GET['date_to'] ?? '';



// if (!empty($type) || !empty($status)) {
//     $logs = getFilteredLogs($pdo, $user_id, $action, $date_from, $date_to);
//     $totalPages = 1;
//     $currentPage = 1;
// } else {
    $total = countAllLogs($pdo, $user, $action ,$date_from, $date_to  );
    $pagination = getPaginationInfo($total, $limit, $page);
    
    $logs = getlogsWithPagination($pdo, $pagination['limit'], $pagination['offset'], $user, $action, $date_from, $date_to);
    $currentPage = $pagination['current_page'];
    $totalPages = $pagination['total_pages'];
// }
?>