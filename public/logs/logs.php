<?php
require_once '../../includes/auth.php';
require_once '../../includes/helpers.php';
requireAdmin();
require_once '../../config/db.php';
require_once '../../controllers/logs/logs_controller.php';
include '../../views/logs/index.php';
