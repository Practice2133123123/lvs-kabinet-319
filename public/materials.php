<?php
require_once '../config/db.php';
require_once '../models/MaterialModel.php';

$items = getAllMaterials($pdo);

require_once '../views/layouts/header.php';
?>

<h1>Список расходов материалов</h1>

<a href="/public/materials_add.php">+ Добавить расход</a>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Материал</th>
            <th>Количество</th>
            <th>Точка</th>
            <th>Дефект</th>
            <th>Кто</th>
            <th>Дата</th>
            <th>Комментарий</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($items) > 0): ?>
            <?php foreach ($items as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['id'] ?? '') ?></td>
                <td><?= htmlspecialchars($item['material_name'] ?? '') ?></td>
                <td><?= htmlspecialchars($item['quantity'] ?? '') ?></td>
                <td><?= htmlspecialchars($item['point_id'] ?? '-') ?></td>
                <td><?= htmlspecialchars($item['defect_id'] ?? '-') ?></td>
                <td><?= htmlspecialchars($item['user_name'] ?? '') ?></td>
                <td><?= htmlspecialchars($item['used_at'] ?? '') ?></td>
                <td><?= htmlspecialchars($item['comment'] ?? '') ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td>Нет данных</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once '../views/layouts/footer.php'; ?>