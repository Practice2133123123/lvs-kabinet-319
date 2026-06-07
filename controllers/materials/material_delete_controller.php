<?php
require_once __DIR__ . '/../models/materials/MaterialModel.php';
require_once __DIR__ . '/../models/logs/LogModel.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$item = getMaterialUsageById($pdo, $id);
$error = '';

if (!$item) {
    die('Расход материала не найден');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (deleteMaterialUsage($pdo, $id)) {
        addLog($pdo, $_SESSION['user_id'], 'DELETE', 'material_usage', $id);
        header('Location: materials.php?deleted=1');
        exit;
    } else {
        $error = 'Ошибка при удалении расхода';
    }
}
?>