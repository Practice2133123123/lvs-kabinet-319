<?php include '../views/layouts/header.php'; ?>

    <h1>Список расходов материалов</h1>

<?php if (empty($items)): ?>
    <p>Нет данных</p>
<?php else: ?>
    <table border="1">
        <thead>
        <tr>
            <th>ID</th>
            <th>Материал</th>
            <th>Количество</th>
            <th>Дата</th>
            <th>Комментарий</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['id'] ?? '') ?></td>
                <td><?= htmlspecialchars($item['material_name'] ?? '') ?></td>
                <td><?= htmlspecialchars($item['quantity'] ?? '') ?></td>
                <td><?= htmlspecialchars($item['used_at'] ?? '') ?></td>
                <td><?= htmlspecialchars($item['comment'] ?? '') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

    <div style="margin-top: 20px;">
        <a href="http://localhost/lvs/public/materials_add.php" class="btn btn-primary">
             Добавить расход
        </a>
    </div>

<?php include '../views/layouts/footer.php'; ?>