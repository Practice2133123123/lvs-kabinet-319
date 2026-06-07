<?php include __DIR__ . '/../layouts/header.php'; ?>

    <h1>Дефекты</h1>
<?php include __DIR__ . '/summary.php'; ?>

    <p><a href="defect_add.php" class="btn btn-primary">+ Добавить новый дефект</a></p>
<?php include __DIR__ . '/filter.php'; ?>

<?php if (empty($defects)): ?>
    <div class="alert alert-info">Нет дефектов</div>
<?php else: ?>
    <table border="1" cellpadding="8" style="width:100%; border-collapse: collapse;">
        <thead style="background: #f0f0f0;">
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
                <td><strong><?= htmlspecialchars($defect['id']) ?></strong></td>
                <td><?= htmlspecialchars($defect['point_label'] ?? '—') ?></td>
                <td><?= htmlspecialchars($defect['category'] ?? '—') ?></td>
                <td>
                    <?php
                    $severity = htmlspecialchars($defect['severity'] ?? '—');
                    $severityClass = strtolower($severity);
                    ?>
                    <span class="status-badge status-<?= $severityClass ?>"><?= $severity ?></span>
                </td>
                <td>
                    <?php
                    $status = htmlspecialchars($defect['status'] ?? '—');
                    $statusClass = strtolower($status);
                    ?>
                    <span class="status-badge status-<?= $statusClass ?>"><?= $status ?></span>
                </td>
                <td>
                    <a href="defect_edit.php?id=<?= $defect['id'] ?>">✏️ Ред.</a>
                    <a href="defect_delete.php?id=<?= $defect['id'] ?>" onclick="return confirm('Удалить дефект?')">🗑 Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

    <!-- Пагинация -->
<?php if ($totalPages > 1): ?>
    <div class="pagination" style="margin-top: 20px; text-align: center;">
        <?php if ($currentPage > 1): ?>
            <a href="?page=<?= $currentPage - 1 ?>&severity=<?= htmlspecialchars($severity ?? '') ?>&status=<?= htmlspecialchars($status ?? '') ?>">◀ Назад</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php if ($i == $currentPage): ?>
                <span class="active" style="margin: 0 5px; color: red; font-weight: bold;"><?= $i ?></span>
            <?php else: ?>
                <a href="?page=<?= $i ?>&severity=<?= htmlspecialchars($severity ?? '') ?>&status=<?= htmlspecialchars($status ?? '') ?>" style="margin: 0 5px;"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>&severity=<?= htmlspecialchars($severity ?? '') ?>&status=<?= htmlspecialchars($status ?? '') ?>">Вперёд ▶</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>