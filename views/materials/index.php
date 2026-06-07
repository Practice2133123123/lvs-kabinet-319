<?php include '../views/layouts/header.php'; ?>

<<<<<<< HEAD
<div class="container mt-4">
    <h1 class="mb-4">Журнал расходов материалов</h1>
    
    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
        <div class="alert alert-success">Расход материала успешно удалён!</div>
    <?php endif; ?>
    
    <?php if (empty($items)): ?>
        <p>Нет данных</p>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
=======
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
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0
                    <tr>
                        <th>ID</th>
                        <th>Материал</th>
                        <th>Количество</th>
                        <th>Ед.изм.</th>
                        <th>Точка</th>
<<<<<<< HEAD
                        <th>Дефект</th>
                        <th>Кто использовал</th>
                        <th>Дата</th>
                        <th>Комментарий</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['id'] ?? '') ?></td>
                        <td><?= htmlspecialchars($item['material_name'] ?? '') ?></td>
                        <td><?= htmlspecialchars($item['quantity'] ?? '') ?></td>
                        <td><?= htmlspecialchars($item['material_unit'] ?? '') ?></td>
                        <td><?= htmlspecialchars($item['point_label'] ?? '—') ?></td>
                        <td><?= htmlspecialchars($item['defect_description'] ?? '—') ?></td>
                        <td><?= htmlspecialchars($item['user_name'] ?? '—') ?></td>
                        <td><?= htmlspecialchars($item['used_at'] ?? '') ?></td>
                        <td><?= htmlspecialchars($item['comment'] ?? '—') ?></td>
                        <td>
                            <a href="material_edit.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-warning">Изменить</a>
                            <a href="material_delete.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Удалить расход?')">Удалить</a>
                </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    
    <div class="mt-3">
        <a href="materials_add.php" class="btn btn-primary">Добавить расход</a>
        <a href="index.php" class="btn btn-secondary">Назад</a>
    </div>
</div>
=======
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
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0

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