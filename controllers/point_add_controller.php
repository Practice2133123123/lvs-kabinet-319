v<?php
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
                $errors[] = "Ошибка при сохранении в базу данных.";
            }
        } catch (PDOException $e) {
            $errors[] = "Ошибка базы данных: " . $e->getMessage();
        }
    }
}
?>