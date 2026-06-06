<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/auth.php';

if (!isAdmin()) {
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../controllers/logs_controller.php';
include __DIR__ . '/../views/logs/index.php';
?>