<?php
require_once __DIR__ . '/../models/defects/DefectModel.php';
require_once __DIR__ . '/../models/inventory/PointModel.php'; 
require_once __DIR__ . '/../models/logs/LogModel.php';

$error = '';
$success = '';
$points = getAllPointsForSelect($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'point_id' => $_POST['point_id'] ?? 0,
        'category' => trim($_POST['category'] ?? ''),
        'severity' => $_POST['severity'] ?? 'medium',
        'description' => trim($_POST['description'] ?? ''),
        'status' => $_POST['status'] ?? 'open'
    ];
    
    if ($data['point_id'] <= 0) {
        $error = 'Выберите сетевую точку';
    } elseif (empty($data['category'])) {
        $error = 'Введите категорию дефекта';
    } elseif (empty($data['description'])) {
        $error = 'Введите описание дефекта';
    } else {
        if (createDefect($pdo, $data, $_SESSION['user_id'])) {
            $defect_id = $pdo->lastInsertId();
            addLog($pdo, $_SESSION['user_id'], 'CREATE', 'defects', $defect_id);
            $success = 'Дефект успешно добавлен!';
            $_POST = [];
        } else {
            $error = 'Ошибка при добавлении дефекта';
        }
    }
}
?>