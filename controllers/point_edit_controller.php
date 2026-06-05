<?php
require_once __DIR__ . '/../models/PointModel.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$errors = [];

$point = getPointById($pdo, $id);

if (!$point) {
    die('Точка не найдена');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $label = trim($_POST['label'] ?? '');
    $type = $_POST['type'] ?? '';
    $location = trim($_POST['location'] ?? '');
    $status = $_POST['status'] ?? '';
    $last_check = $_POST['last_check'] ?? null;

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
            header('Location: inventory.php?success=1');
            exit;
        } else {
            $errors[] = 'Ошибка при сохранении';
        }
    }
}
?>