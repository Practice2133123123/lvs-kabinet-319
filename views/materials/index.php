<?php include __DIR__ . '/../layouts/header.php'; ?>

    <h1>Материалы</h1>

    <div class="container mt-4">
        <?php include __DIR__ . '/summary.php'; ?>

        <?php include __DIR__ . '/filter.php'; ?>

        <!-- Таблица -->
        <div class="table-responsive">
            <?php if (empty($items)): ?>
                <div class="alert alert-info">Нет записей. <a href="materials_add.php">Добавить →</a></div>
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
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($item['id']) ?></strong></td>
                            <td><?= htmlspecialchars($item['material_name']) ?></td>
                            <td style="text-align: center;"><?= htmlspecialchars($item['quantity']) ?></td>
                            <td style="text-align: center;"><?= $item['unit'] == 'm' ? 'м' : 'шт' ?></td>
                            <td><?= htmlspecialchars($item['point_label'] ?? '—') ?></td>
                            <td><?= htmlspecialchars($item['user_name'] ?? '—') ?></td>
                            <td><small><?= htmlspecialchars($item['used_at']) ?></small></td>
                            <td><small><?= htmlspecialchars($item['comment'] ?? '—') ?></small></td>
                            <td>
                                <a href="material_edit.php?id=<?= $item['id'] ?>">✏️ Ред.</a>
                                <a href="material_delete.php?id=<?= $item['id'] ?>" onclick="return confirm('Удалить запись о расходе?')">🗑 Удалить</a>
                            </td>
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
    <div class="pagination" style="margin-top: 20px; text-align: center;">
        <?php if ($currentPage > 1): ?>
            <a href="?page=<?= $currentPage - 1 ?>&date_from=<?= htmlspecialchars($date_from ?? '') ?>&date_to=<?= htmlspecialchars($date_to ?? '') ?>&material_id=<?= htmlspecialchars($material_id ?? '') ?>">◀ Назад</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php if ($i == $currentPage): ?>
                <span class="active" style="margin: 0 5px; color: red; font-weight: bold;"><?= $i ?></span>
            <?php else: ?>
                <a href="?page=<?= $i ?>&date_from=<?= htmlspecialchars($date_from ?? '') ?>&date_to=<?= htmlspecialchars($date_to ?? '') ?>&material_id=<?= htmlspecialchars($material_id ?? '') ?>" style="margin: 0 5px;"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>&date_from=<?= htmlspecialchars($date_from ?? '') ?>&date_to=<?= htmlspecialchars($date_to ?? '') ?>&material_id=<?= htmlspecialchars($material_id ?? '') ?>">Вперёд ▶</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>