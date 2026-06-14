<?php
require_once __DIR__ . '/../../models/defects/DefectModel.php';
require_once __DIR__ . '/../../models/inventory/PointModel.php';
require_once __DIR__ . '/../../models/logs/LogModel.php';
require_once __DIR__ . '/../../includes/helpers.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$defect = getDefectById($pdo, $id);
$points = getAllPointsForSelect($pdo);

if (!$defect) {
    die('Дефект не найден');
}

$error = '';
$success = '';

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
        if (updateDefect($pdo, $id, $data)) {
            addLog($pdo, $_SESSION['user_id'], 'UPDATE', 'defects', $id);
            $success = 'Дефект успешно обновлён!';
            $defect = getDefectById($pdo, $id);
        } else {
            $error = 'Ошибка при обновлении дефекта';
        }
    }
}