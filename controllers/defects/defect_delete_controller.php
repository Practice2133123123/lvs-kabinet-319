<?php
require_once __DIR__ . '/../models/defects/DefectModel.php';
require_once __DIR__ . '/../models/logs/LogModel.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$defect = getDefectById($pdo, $id);
$error = '';

if (!$defect) {
    die('Дефект не найден');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (hasMaterialUsage($pdo, $id)) {
        $error = 'Нельзя удалить дефект! Сначала удалите все связанные расходы материалов.';
    } else {
        if (deleteDefect($pdo, $id)) {
            addLog($pdo, $_SESSION['user_id'], 'DELETE', 'defects', $id);
            header('Location: defects.php?deleted=1');
            exit;
        } else {
            $error = 'Ошибка при удалении дефекта';
        }
    }
}
?>