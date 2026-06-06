<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/DefectModel.php';
$defects = getAllDefects($pdo);
include __DIR__ . '/../views/defects/index.php';
