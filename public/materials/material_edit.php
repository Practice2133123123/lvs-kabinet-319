<?php
require_once '../../includes/auth.php';
require_once '../../includes/helpers.php';
requireAuth();
require_once '../../config/db.php';
require_once '../../controllers/materials/material_edit_controller.php';
include '../../views/materials/edit.php';
?>