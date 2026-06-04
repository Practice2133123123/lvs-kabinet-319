<?php
require_once '../config/db.php';
require_once '../includes/auth.php';

if (!isAdmin()) {
    header('Location: index.php');
    exit;
}

include '../views/logs/index.php';
