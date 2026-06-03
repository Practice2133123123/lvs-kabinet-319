<?php
require_once '../models/MaterialModel.php';
require_once '../config/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = addMaterial($pdo, $_POST);
    
    if ($result) {
        header('Location: ../public/materials.php');
    } else {
        header('Location: ../public/materials_add.php');
    }
    exit;
}
?>