<?php
require_once __DIR__ . '/../../models/inventory/PointModel.php';
require_once __DIR__ . '/../../includes/helpers.php';

$id = getGetParam('id', 'int', 0);
$errors = [];

$point = getPointById($pdo, $id);

if (!$point) {
    die('Точка не найдена');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $label = getPostParam('label', 'string');
    $type = getPostParam('type', 'string');
    $location = getPostParam('location', 'string');
    $status = getPostParam('status', 'string');
    $last_check = getPostParam('last_check');

    if (empty($label)) {
        $errors[] = 'Метка обязательна для заполнения';
    }

    if (!in_array($type, ['socket', 'switch', 'cable_run', 'patch_cord'])) {
        $errors[] = 'Некорректный тип точки';
    }

    if (!in_array($status, ['active', 'defect', 'decommissioned'])) {
        $errors[] = 'Некорректный статус';
    }

    if (empty($errors)) {
        $data = [
            'label' => $label,
            'type' => $type,
            'location' => $location,
            'status' => $status,
            'last_check' => $last_check
        ];

        if (updatePoint($pdo, $id, $data)) {
            header('Location: ../inventory/inventory.php?success=1');
            exit;
        } else {
            $errors[] = 'Ошибка при сохранении';
        }
    }
}
?>