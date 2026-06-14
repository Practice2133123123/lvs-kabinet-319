<?php
require_once __DIR__ . '/../../models/defects/DefectModel.php';
require_once __DIR__ . '/../../models/inventory/PointModel.php'; // Для getAllPointsForSelect()
require_once __DIR__ . '/../../models/logs/LogModel.php';
require_once __DIR__ . '/../../includes/helpers.php';

$error = '';
$success = '';
$points = getAllPointsForSelect($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    validateCsrfToken();

    $data = [
        'point_id' => getPostParam('point_id', 'int'),
        'category' => getPostParam('category', 'string'),
        'severity' => getPostParam('severity', 'string', 'medium'),
        'description' => getPostParam('description', 'string'),
        'status' => getPostParam('status', 'string', 'open')
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