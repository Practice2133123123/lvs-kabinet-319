<?php
require_once __DIR__ . '/../../models/materials/MaterialModel.php';
require_once __DIR__ . '/../../models/inventory/PointModel.php'; 
require_once __DIR__ . '/../../models/logs/LogModel.php';
require_once __DIR__ . '/../../includes/helpers.php';

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
    validateCsrfToken();

    $data = [
        'material_id' => getPostParam('material_id', 'int'),
        'quantity' => getPostParam('quantity', 'int'),
        'point_id' => getPostParam('point_id', 'int', null),
        'defect_id' => getPostParam('defect_id', 'int', null),
        'used_by' => getPostParam('used_by', 'int', $_SESSION['user_id']),
        'comment' => getPostParam('comment', 'string')
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