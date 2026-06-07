<?php
require_once __DIR__ . '/../../models/logs/LogModel.php';
require_once __DIR__ . '/../../models/auth/UserModel.php';
require_once __DIR__ . '/../../includes/helpers.php';

$user_id = getGetParam('user_id', 'int');
$action = getGetParam('action', 'string');
$date_from = getGetParam('date_from', 'date');
$date_to = getGetParam('date_to', 'date');

$logs = getFilteredLogs($pdo, $user_id, $action, $date_from, $date_to);
$users = getAllUsers($pdo);
?>