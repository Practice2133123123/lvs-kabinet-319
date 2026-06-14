<?php include __DIR__ . '/../../views/layouts/header.php'; ?>

    <h1>Дефекты</h1>

    <p><a href="defect_add.php" class="btn btn-primary">+ Добавить дефект</a></p>

<?php include __DIR__ . '/summary.php'; ?>
<?php include __DIR__ . '/filter.php'; ?>

<?php if (empty($defects)): ?>
    <div class="empty-state">Нет дефектов.</div>
<?php else: ?>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Точка</th>
            <th>Категория</th>
            <th>Критичность</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($defects as $defect): ?>
            <tr>
                <td><?= htmlspecialchars($defect['id']) ?></td>
                <td><?= htmlspecialchars($defect['point_label'] ?? '—') ?></td>
                <td><?= htmlspecialchars($defect['category'] ?? '—') ?></td>
                <td><?= htmlspecialchars($defect['severity'] ?? '—') ?></td>
                <td><?= htmlspecialchars($defect['status'] ?? '—') ?></td>
                <td>
                    <a href="defect_edit.php?id=<?= $defect['id'] ?>" class="btn-action btn-action-edit">Ред.</a>
                    <a href="defect_delete.php?id=<?= $defect['id'] ?>" class="btn-action btn-action-delete" onclick="return confirm('Удалить дефект?')">Удал.</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php if ($totalPages > 1): ?>
    <div class="pagination-links">
        <?php if ($currentPage > 1): ?>
            <?php 
                $params = $_GET;
                $params['page'] = $currentPage - 1;
                $linkBack = "?" . http_build_query($params); ?>
            <a href="<?= $linkBack ?>">← Назад</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php 
                $params = $_GET;
                $params['page'] = $i;
                $linkPage = "?" . http_build_query($params); ?>
            <?php if ($i == $currentPage): ?>
                <strong><?= $i ?></strong>
            <?php else: ?>
                <a href="<?= $linkPage?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if ($currentPage < $totalPages): ?>
                <?php 
                $params = $_GET;
                $params['page'] = $currentPage + 1;
                $linkNext = "?" . http_build_query($params); ?>
            <a href="<?= $linkNext ?>">Вперёд →</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../../views/layouts/footer.php'; ?>
