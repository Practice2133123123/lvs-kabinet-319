<?php include '../views/layouts/header.php'; ?>

    <h2>Журнал дефектов</h2>
    <table class="table">
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
            <td><?= htmlspecialchars($defect['id']) ?></td>
            <td><?= htmlspecialchars($defect['network_label']) ?></td>
            <td><?= htmlspecialchars($defect['category']) ?></td>
            <td>
                <span class="badge badge-<?= htmlspecialchars($defect['severity']) ?>">
                    <?= htmlspecialchars($defect['severity']) ?>
                </span>
            </td>
            <td>
                <span class="badge badge-<?= htmlspecialchars($defect['status']) ?>">
                    <?= htmlspecialchars($defect['status']) ?>
                </span>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    ?>

<?php include '../views/layouts/footer.php'; ?>