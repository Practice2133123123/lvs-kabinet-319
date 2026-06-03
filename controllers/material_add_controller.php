<?php
require_once '../config/db.php';
require_once '../models/MaterialModel.php';

$error = '';
$success = '';

$materials = getMaterialsList($pdo);
$points = getPointsList($pdo);
$defects = getDefectsList($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $material_id = $_POST['material_id'] ?? 0;
    $quantity = $_POST['quantity'] ?? 0;
    $point_id = $_POST['point_id'] ?? null;
    $defect_id = $_POST['defect_id'] ?? null;
    $comment = $_POST['comment'] ?? '';

    if ($material_id > 0 && $quantity > 0) {
        $data = [
            'material_id' => $material_id,
            'quantity' => $quantity,
            'point_id' => $point_id ?: null,
            'defect_id' => $defect_id ?: null,
            'used_by' => $_SESSION['user_id'],
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