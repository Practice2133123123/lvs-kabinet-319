<?php
require_once __DIR__ . '/../../models/inventory/PointModel.php';
require_once __DIR__ . '/../../includes/helpers.php';

$id = getGetParam('id', 'int', 0);
$error = '';

$point = getPointById($pdo, $id);

if (!$point) {
    die('Точка не найдена');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    validateCsrfToken();
    if (hasDefects($pdo, $id)) {
        $error = 'Нельзя удалить точку! Сначала удалите все дефекты, связанные с этой точкой.';
    } else {
        if (deletePoint($pdo, $id)) {
            header('Location: ../inventory/inventory.php?deleted=1');
            exit;
        } else {
            $error = 'Ошибка при удалении';
        }
    }
}
?>