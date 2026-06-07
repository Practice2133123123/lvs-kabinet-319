<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/materials/MaterialModel.php';
require_once __DIR__ . '/../../includes/helpers.php';

$error = '';
$success = '';

$materials = getMaterialsList($pdo);
$points = getPointsList($pdo);
$defects = getDefectsList($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $material_id = getPostParam('material_id', 'int', 0);
    $quantity = getPostParam('quantity', 'int', 0);
    $point_id = getPostParam('point_id', 'int');
    $defect_id = getPostParam('defect_id', 'int');
    $comment = getPostParam('comment', 'string');

    if ($material_id > 0 && $quantity > 0) {
        $data = [
            'material_id' => $material_id,
            'quantity' => $quantity,
            'point_id' => $point_id ?: null,
            'defect_id' => $defect_id ?: null,
            'used_by' => $_SESSION['user_id'] ?? 1,
            'comment' => $comment
        ];

        if (addMaterialUsage($pdo, $data)) {
            $success = 'Расход успешно добавлен!';
            $_POST = [];
        } else {
            $error = 'Ошибка при добавлении расхода';
        }
    } else {
        $error = 'Заполните обязательные поля: материал и количество';
    }
}
?>