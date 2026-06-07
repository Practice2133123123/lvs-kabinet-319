<?php include '../views/layouts/header.php'; ?>

<<<<<<< HEAD
<div class="container mt-4">
    <h1 class="mb-4">Журнал дефектов</h1>
    
    <?php if (isset($_GET['created']) && $_GET['created'] == 1): ?>
        <div class="alert alert-success">Дефект успешно добавлен!</div>
    <?php endif; ?>
    <?php if (isset($_GET['updated']) && $_GET['updated'] == 1): ?>
        <div class="alert alert-success">Дефект успешно обновлён!</div>
    <?php endif; ?>
    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
        <div class="alert alert-success">Дефект успешно удалён!</div>
    <?php endif; ?>
    
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Точка</th>
                    <th>Категория</th>
                    <th>Критичность</th>
                    <th>Статус</th>
                    <th>Создал</th>
                    <th>Дата</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($defects as $defect): ?>
                <tr>
<td><?= htmlspecialchars($defect['id']) ?></td>
<td><?= htmlspecialchars($defect['point_label'] ?? '—') ?></td>
<td><?= htmlspecialchars($defect['category'] ?? '—') ?></td>
<td>
            <span class="badge badge-<?= htmlspecialchars($defect['severity']) ?>">
            <?= htmlspecialchars($defect['severity']) ?>
            </span>
            </span>
        <td>
<span class="badge badge-<?= htmlspecialchars($defect['status']) ?>">
            <?= htmlspecialchars($defect['status']) ?>
                </span>
            </span>
        <td><?= htmlspecialchars($defect['created_by_name'] ?? '—') ?></td>
        <td><?= htmlspecialchars($defect['created_at']) ?></td>
        <td>
        <a href="defect_edit.php?id=<?= $defect['id'] ?>" class="btn btn-sm btn-warning">Изменить</a>
        <a href="defect_delete.php?id=<?= $defect['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Удалить дефект?')">Удалить</a>
</span>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div class="mt-3">
        <a href="defect_add.php" class="btn btn-primary">Добавить дефект</a>
        <a href="index.php" class="btn btn-secondary">Назад</a>
    </div>
</div>
=======
    <h2>Журнал дефектов</h2>
<?php include 'summary.php'; ?>
<?php include 'filter.php'; ?>


<?php if (empty($defects)): ?>
    <p>Нет данных</p>
<?php else: ?>
    <table border="1" cellpadding="8" style="width:100%; border-collapse: collapse;">
        <thead style="background: #f0f0f0;">
        <tr>
            <th>ID</th>
            <th>Точка</th>
            <th>Категория</th>
            <th>Критичность</th>
            <th>Статус</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($defects as $defect): ?>
            <tr>
                <td><?= htmlspecialchars($defect['id']) ?></td>
                <td><?= htmlspecialchars($defect['network_label'] ?? '—') ?></td>
                <td><?= htmlspecialchars($defect['category'] ?? '—') ?></td>
                <td><?= htmlspecialchars($defect['severity'] ?? '—') ?></td>
                <td><?= htmlspecialchars($defect['status'] ?? '—') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
    <!-- Пагинация -->
<?php if ($totalPages > 1): ?>
    <div style="margin-top: 20px; text-align: center;">
        <?php if ($currentPage > 1): ?>
            <a href="?page=<?= $currentPage - 1 ?>&severity=<?= htmlspecialchars($severity) ?>&status=<?= htmlspecialchars($status) ?>">◀ Назад</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php if ($i == $currentPage): ?>
                <strong style="margin: 0 5px; color: red;"><?= $i ?></strong>
            <?php else: ?>
                <a href="?page=<?= $i ?>&severity=<?= htmlspecialchars($severity) ?>&status=<?= htmlspecialchars($status) ?>" style="margin: 0 5px;"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>&severity=<?= htmlspecialchars($severity) ?>&status=<?= htmlspecialchars($status) ?>">Вперёд ▶</a>
        <?php endif; ?>
    </div>
<?php endif; ?>
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0

<?php include '../views/layouts/footer.php'; ?>