<?php include '../views/layouts/header.php'; ?>

    <div class="container mt-4">
        <h1 class="mb-4">Журнал расходов материалов</h1>

        <?php include __DIR__ . '/summary.php'; ?>

        <?php include __DIR__ . '/filter.php'; ?>

        <!-- Таблица -->
        <div class="table-responsive">
            <?php if (empty($items)): ?>
                <p>Нет данных</p>
            <?php else: ?>
                <table border="1" cellpadding="8" style="width:100%; border-collapse: collapse;">
                    <thead style="background: #f0f0f0;">
                    <tr>
                        <th>ID</th>
                        <th>Материал</th>
                        <th>Количество</th>
                        <th>Ед.изм.</th>
                        <th>Точка</th>
                        <th>Кто использовал</th>
                        <th>Дата</th>
                        <th>Комментарий</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['id']) ?></td>
                            <td><?= htmlspecialchars($item['material_name']) ?></td>
                            <td><?= htmlspecialchars($item['quantity']) ?></td>
                            <td><?= $item['unit'] == 'm' ? 'м' : 'шт' ?></td>
                            <td><?= htmlspecialchars($item['point_label'] ?? '—') ?></td>
                            <td><?= htmlspecialchars($item['user_name'] ?? '—') ?></td>
                            <td><?= htmlspecialchars($item['used_at']) ?></td>
                            <td><?= htmlspecialchars($item['comment'] ?? '—') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <div style="margin-top: 20px;">
            <a href="materials_add.php" class="btn btn-primary">➕ Добавить расход</a>
        </div>
    </div>
    <!-- Пагинация -->
<?php if ($totalPages > 1): ?>
    <div style="margin-top: 20px; text-align: center;">
        <?php if ($currentPage > 1): ?>
            <a href="?page=<?= $currentPage - 1 ?>&date_from=<?= htmlspecialchars($date_from) ?>&date_to=<?= htmlspecialchars($date_to) ?>&material_id=<?= htmlspecialchars($material_id) ?>">◀ Назад</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php if ($i == $currentPage): ?>
                <strong style="margin: 0 5px; color: red;"><?= $i ?></strong>
            <?php else: ?>
                <a href="?page=<?= $i ?>&date_from=<?= htmlspecialchars($date_from) ?>&date_to=<?= htmlspecialchars($date_to) ?>&material_id=<?= htmlspecialchars($material_id) ?>" style="margin: 0 5px;"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>&date_from=<?= htmlspecialchars($date_from) ?>&date_to=<?= htmlspecialchars($date_to) ?>&material_id=<?= htmlspecialchars($material_id) ?>">Вперёд ▶</a>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php include '../views/layouts/footer.php'; ?>