<?php
require_once '../config/db.php';
require_once '../includes/auth.php';

if (!isAdmin()) {
    header('Location: index.php');
    exit;
}

require_once '../controllers/users_controller.php';
include '../views/users/index.php';
?>