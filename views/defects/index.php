<?php include '../views/layouts/header.php'; 


?>

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

<?php include '../views/layouts/footer.php'; ?>