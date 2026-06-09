<?php
require_once __DIR__ . '/../../models/inventory/PointModel.php';
require_once __DIR__ . '/../../includes/helpers.php';

$errors = [];

$label = trim($_POST['label'] ?? '');

if (countPointsByLabel($pdo, $label) > 0) {
    $errors[] = "Точка с таким названием уже существует.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'label' => getPostParam('label', 'string'),
        'type' => getPostParam('type', 'string'),
        'location' => getPostParam('location', 'string'),
        'status' => getPostParam('status', 'string'),
        'last_check' => getPostParam('last_check'),
        'created_by' => $_SESSION['user_id'] ?? 1
    ];

    $allowedTypes = ['socket', 'switch', 'cable_run', 'patch_cord'];
    if (!in_array($data['type'], $allowedTypes)) {
        $errors[] = "Выбран некорректный тип точки.";
    }

    $allowedStatuses = ['active', 'defect', 'decommissioned'];
    if (!in_array($data['status'], $allowedStatuses)) {
        $errors[] = "Выбран некорректный статус.";
    }

    if (empty($errors)) {
        try {
            if (createPoint($pdo, $data)) {
                header("Location: ../inventory/inventory.php");
                exit;
            } else {
                $errors[] = "Ошибка при сохранении в базу данных.";
            }
        } catch (PDOException $e) {
            $errors[] = "Ошибка базы данных: " . $e->getMessage();
        }
    }
}
?>
