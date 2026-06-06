<?php include __DIR__ . '/../layouts/header.php'; ?>

    <h1>Материалы</h1>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div></div>
        <a href="materials_add.php" class="btn btn-success">Добавить запись</a>
    </div>

    <?php include __DIR__ . '/summary.php'; ?>
    <?php include __DIR__ . '/filter.php'; ?>

    <!-- Таблица -->
    <?php if (empty($items)): ?>
        <div class="alert alert-info">Нет записей. <a href="materials_add.php">Добавить →</a></div>
    <?php else: ?>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Материал</th>
                <th>Кол-во</th>
                <th>Ед.</th>
                <th>Точка</th>
                <th>Пользователь</th>
                <th>Дата</th>
                <th>Комментарий</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><strong><?= htmlspecialchars($item['id']) ?></strong></td>
                    <td><?= htmlspecialchars($item['material_name']) ?></td>
                    <td class="text-center"><?= htmlspecialchars($item['quantity']) ?></td>
                    <td class="text-center"><?= $item['unit'] == 'm' ? 'м' : 'шт' ?></td>
                    <td><?= htmlspecialchars($item['point_label'] ?? '—') ?></td>
                    <td><?= htmlspecialchars($item['user_name'] ?? '—') ?></td>
                    <td><small><?= htmlspecialchars($item['used_at']) ?></small></td>
                    <td><small><?= htmlspecialchars($item['comment'] ?? '—') ?></small></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <!-- Пагинация -->
<?php if ($totalPages > 1): ?>
    <div class="pagination">
        <?php if ($currentPage > 1): ?>
            <a href="?page=<?= $currentPage - 1 ?>&date_from=<?= htmlspecialchars($date_from) ?>&date_to=<?= htmlspecialchars($date_to) ?>&material_id=<?= htmlspecialchars($material_id) ?>">Назад</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php if ($i == $currentPage): ?>
                <span class="active"><?= $i ?></span>
            <?php else: ?>
                <a href="?page=<?= $i ?>&date_from=<?= htmlspecialchars($date_from) ?>&date_to=<?= htmlspecialchars($date_to) ?>&material_id=<?= htmlspecialchars($material_id) ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>&date_from=<?= htmlspecialchars($date_from) ?>&date_to=<?= htmlspecialchars($date_to) ?>&material_id=<?= htmlspecialchars($material_id) ?>">Вперёд</a>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php include __DIR__ . '/../layouts/footer.php'; ?>