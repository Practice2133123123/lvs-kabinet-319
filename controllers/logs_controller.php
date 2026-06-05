<?php
require_once __DIR__ . '/../models/LogModel.php';
require_once __DIR__ . '/../models/UserModel.php';

$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 100;
$user_filter = isset($_GET['user_id']) ? (int)$_GET['user_id'] : null;

if ($user_filter) {
    $logs = getLogsByUser($pdo, $user_filter, $limit);
} else {
    $logs = getAllLogs($pdo, $limit);
}

$users = getAllUsers($pdo);
?>