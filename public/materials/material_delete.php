<?php
require_once '../../includes/auth.php';
require_once '../../includes/helpers.php';
requireAuth();
require_once '../../config/db.php';
require_once '../../controllers/materials/material_delete_controller.php';
include '../../views/materials/delete.php';
?>