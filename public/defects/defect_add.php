<?php
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/helpers.php';
requireAuth();
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../controllers/defects/defects_add_controller.php';
include __DIR__ . '/../../views/defects/add.php';
?>
