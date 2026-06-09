<?php
require_once '../../config/db.php';
require_once '../../includes/auth.php';
requireAuth();
require_once '../../controllers/points/point_edit_controller.php';
require_once '../../views/layouts/header.php';
include '../../views/inventory/edit.php';
require_once '../../views/layouts/footer.php';
