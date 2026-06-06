<?php include __DIR__ . '/../layouts/header.php'; ?>

    <h1>Дефекты</h1>
<?php include 'summary.php'; ?>
<?php include 'filter.php'; ?>

<?php if (empty($defects)): ?>
    <div class="alert alert-info">Нет дефектов</div>
<?php else: ?>
    <table>
        <thead>
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
                <td><strong><?= htmlspecialchars($defect['id']) ?></strong></td>
                <td><?= htmlspecialchars($defect['network_label'] ?? '—') ?></td>
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
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

    <!-- Пагинация -->
<?php if ($totalPages > 1): ?>
    <div class="pagination">
        <?php if ($currentPage > 1): ?>
            <a href="?page=<?= $currentPage - 1 ?>&severity=<?= htmlspecialchars($severity) ?>&status=<?= htmlspecialchars($status) ?>">Назад</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php if ($i == $currentPage): ?>
                <span class="active"><?= $i ?></span>
            <?php else: ?>
                <a href="?page=<?= $i ?>&severity=<?= htmlspecialchars($severity) ?>&status=<?= htmlspecialchars($status) ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>&severity=<?= htmlspecialchars($severity) ?>&status=<?= htmlspecialchars($status) ?>">Вперёд</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>