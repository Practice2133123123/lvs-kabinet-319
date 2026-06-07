<?php
require_once __DIR__ . '/../config/db.php';  // Исправлено: добавлено /../
require_once __DIR__ . '/../models/LogModel.php';

session_start();
if (isset($_SESSION['user_id'])) {
    addLoginLog($pdo, $_SESSION['user_id'], 'LOGOUT');
}
session_destroy();
header('Location: login.php');
exit;
?>