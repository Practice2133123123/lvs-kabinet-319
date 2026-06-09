<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../config/db.php';
require_once '../../includes/auth.php';
requireAuth();
require_once '../../controllers/materials/material_edit_controller.php';
include '../../views/materials/edit.php';
?>