<?php
require_once  __DIR__ . '/../models/PointModel.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'label' => trim($_POST['label'] ?? ''),
        'type' => trim($_POST['type'] ?? ''),
        'location' => trim($_POST['location'] ?? ''),
        'status' => trim($_POST['status'] ?? ''),
        'last_check' => !empty($_POST['last_check']) ? $_POST['last_check'] : null
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
                header("Location: inventory.php");
                exit;
            } else {
                $errors[] = "Ошибка при сохранении в базу данных.";
            }
        } catch (PDOException $e) {
            $errors[] = "Ошибка базы данных: " . $e->getMessage();
        }
    }
}
?><?php
