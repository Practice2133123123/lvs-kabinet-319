<?php
require_once '../../includes/auth.php';
require_once '../../includes/helpers.php';
requireAuth();
require_once '../../config/db.php';
require_once '../../controllers/points/point_add_controller.php';
include '../../views/point/add.php';
