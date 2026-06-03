<?php
require_once '../config/db.php';
require_once '../models/MaterialModel.php';

$materials = getMaterialsList($pdo);
$users = getUsersList($pdo);

require_once '../views/layouts/header.php';
?>

<h1>Добавить расход материала</h1>

<form method="POST" action="/controllers/materials_controller.php">
    <select name="material_id" >
        <option value="">Выберите материал</option>
        <?php foreach ($materials as $m): ?>
            <option value="<?= $m['id'] ?>"><?= $m['name'] ?></option>
        <?php endforeach; ?>
    </select>
    
    <input type="number" step="0.01" name="quantity" placeholder="Количество" >
    <input type="number" name="point_id" placeholder="ID точки">
    <input type="number" name="defect_id" placeholder="ID дефекта">
    
    <select name="used_by" >
        <option value="">Кто использовал</option>
        <?php foreach ($users as $u): ?>
            <option value="<?= $u['id'] ?>"><?= $u['login'] ?></option>
        <?php endforeach; ?>
    </select>
    
    <textarea name="comment" placeholder="Комментарий"></textarea>
    
    <button type="submit">Добавить</button>
</form>

<a href="../views/materials/index.php">Назад к списку</a>

<?php require_once '../views/layouts/footer.php'; ?>