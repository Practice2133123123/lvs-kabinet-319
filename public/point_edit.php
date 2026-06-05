<?php
require_once '../config/db.php';
<<<<<<< HEAD
require_once  '../includes/auth.php';
    require_once '../controllers/point_edit_controller.php';
require_once  '../views/layouts/header.php';
include   '../views/inventory/edit.php';
require_once   '../views/layouts/footer.php';
=======
require_once '../models/PointModel.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$errors = [];

// Получаем данные точки
$point = getPointById($pdo, $id);

if (!$point) {
    die('Точка не найдена');
}

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $label = trim($_POST['label'] ?? '');
    $type = $_POST['type'] ?? '';
    $location = trim($_POST['location'] ?? '');
    $status = $_POST['status'] ?? '';
    
    // Валидация
    if (empty($label)) {
        $errors[] = 'Метка обязательна для заполнения';
    }
    
    if (!in_array($type, ['socket', 'switch', 'cable_run', 'patch_cord'])) {
        $errors[] = 'Некорректный тип точки';
    }
    
    if (!in_array($status, ['active', 'defect', 'decommissioned'])) {
        $errors[] = 'Некорректный статус';
    }
    
    if (empty($errors)) {
        $data = [
            'label' => $label,
            'type' => $type,
            'location' => $location,
            'status' => $status
        ];
        
        if (updatePoint($pdo, $id, $data)) {
            header('Location: inventory.php?success=1');
            exit;
        } else {
            $errors[] = 'Ошибка при сохранении';
        }
    }
}

require_once '../views/layouts/header.php';
require_once '../views/inventory/edit.php';
require_once '../views/layouts/footer.php';
?>
>>>>>>> dc38333d443785fcc3bba21a74c498e51dd4f5fa
