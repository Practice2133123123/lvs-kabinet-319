<?php include '../views/layouts/header.php'; ?>

    <h2>Журнал дефектов</h2>
    <table class="table">
        <thead>
        <tr><th>ID</th><th>Точка</th><th>Категория</th><th>Критичность</th><th>Статус</th></tr>
        </thead>
        <tbody>
        <?php foreach ($defects as $defect): ?>
            <tr>
                <td><?= htmlspecialchars($defect['id']) ?></td>
                <td><?= htmlspecialchars($defect['point_label']) ?></td>
                <td><?= htmlspecialchars($defect['category']) ?></td>
                <td><?= htmlspecialchars($defect['severity']) ?></td>
                <td><?= htmlspecialchars($defect['status']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php include '../views/layouts/footer.php'; ?>