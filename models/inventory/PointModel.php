<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/materials/MaterialModel.php';
require_once __DIR__ . '/../../models/inventory/PointModel.php';
require_once __DIR__ . '/../../models/logs/LogModel.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$item = getMaterialUsageById($pdo, $id);
$materials = getMaterialsList($pdo);
$points = getAllPointsForSelect($pdo);
$defects = getDefectsList($pdo);
$users = getAllUsersList($pdo);

if (!$item) {
    die('Расход материала не найден');
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'material_id' => $_POST['material_id'] ?? 0,
        'quantity' => $_POST['quantity'] ?? 0,
        'point_id' => $_POST['point_id'] ?? null,
        'defect_id' => $_POST['defect_id'] ?? null,
        'used_by' => $_POST['used_by'] ?? $_SESSION['user_id'],
        'comment' => trim($_POST['comment'] ?? '')
    ];

    if ($data['material_id'] <= 0) {
        $error = 'Выберите материал';
    } elseif ($data['quantity'] <= 0) {
        $error = 'Количество должно быть больше 0';
    } else {
        if (updateMaterialUsage($pdo, $id, $data)) {
            addLog($pdo, $_SESSION['user_id'], 'UPDATE', 'material_usage', $id);
            $success = 'Расход материала успешно обновлён!';
            $item = getMaterialUsageById($pdo, $id);
        } else {
            $error = 'Ошибка при обновлении расхода';
        }
    }
}
?>