<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../config/db.php';
require_once '../../includes/auth.php';
require_once '../../controllers/defects/defect_delete_controller.php';
include '../../views/defects/delete.php';
?>
