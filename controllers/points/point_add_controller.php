<?php
<<<<<<< HEAD:controllers/point_add_controller.php
require_once __DIR__ . '/../models/PointModel.php';
require_once __DIR__ . '/../models/LogModel.php';
=======
require_once __DIR__ . '/../../models/inventory/PointModel.php';
require_once __DIR__ . '/../../includes/helpers.php';
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0:controllers/points/point_add_controller.php

$errors = [];
$data = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'label' => getPostParam('label', 'string'),
        'type' => getPostParam('type', 'string'),
        'location' => getPostParam('location', 'string'),
        'status' => getPostParam('status', 'string'),
        'last_check' => getPostParam('last_check'),
        'created_by' => $_SESSION['user_id'] ?? 1
    ];

    // Валидация метки
    if (empty($data['label'])) {
        $errors[] = "Метка обязательна для заполнения.";
    } elseif (isLabelExists($pdo, $data['label'])) {
        $errors[] = "Точка с меткой '{$data['label']}' уже существует. Используйте другую метку.";
    }

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
<<<<<<< HEAD:controllers/point_add_controller.php
            $result = createPoint($pdo, $data, $_SESSION['user_id']);
            if ($result) {
                addLog($pdo, $_SESSION['user_id'], 'CREATE', 'network_points', $pdo->lastInsertId());
                header("Location: inventory.php?created=1");
=======
            if (addPoint($pdo, $data)) {
                header("Location: ../inventory/inventory.php");
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0:controllers/points/point_add_controller.php
                exit;
            } else {
                $errors[] = "Точка с такой меткой уже существует или ошибка при сохранении.";
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000 && strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $errors[] = "Точка с меткой '{$data['label']}' уже существует. Используйте другую метку.";
            } else {
                $errors[] = "Ошибка базы данных: " . $e->getMessage();
            }
        }
    }
}
<<<<<<< HEAD:controllers/point_add_controller.php
?>
=======
?>
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0:controllers/points/point_add_controller.php
