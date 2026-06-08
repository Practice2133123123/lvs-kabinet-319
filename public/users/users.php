<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once '../../config/db.php';
require_once '../../includes/auth.php';

if (!isAdmin()) {
    header('Location: ../dashboard/index.php');
    exit;
}

require_once '../../controllers/users/users_controller.php';
include '../../views/users/index.php';
?>