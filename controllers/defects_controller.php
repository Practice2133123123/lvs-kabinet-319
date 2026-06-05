<?php
require_once __DIR__ . '/../models/DefectModel.php';

$severity = isset($_GET['severity']) ? $_GET['severity'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

$defects = getAllDefects($pdo, $severity, $status);