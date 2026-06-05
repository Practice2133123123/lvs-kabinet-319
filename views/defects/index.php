<?php include '../views/layouts/header.php'; ?>

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

<?php include '../views/layouts/footer.php'; ?>