<?php
require_once __DIR__ . '/../models/PointModel.php';
require_once __DIR__ . '/../models/LogModel.php';

$errors = [];
$data = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'label' => trim($_POST['label'] ?? ''),
        'type' => trim($_POST['type'] ?? ''),
        'location' => trim($_POST['location'] ?? ''),
        'status' => trim($_POST['status'] ?? ''),
        'last_check' => !empty($_POST['last_check']) ? $_POST['last_check'] : null
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
            $result = createPoint($pdo, $data, $_SESSION['user_id']);
            if ($result) {
                addLog($pdo, $_SESSION['user_id'], 'CREATE', 'network_points', $pdo->lastInsertId());
                header("Location: inventory.php?created=1");
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
?>