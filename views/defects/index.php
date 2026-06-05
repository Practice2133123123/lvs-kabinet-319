<?php include '../views/layouts/header.php'; 


?>

    <div class="container">
        <h1>Журнал дефектов</h1>

        <div class="table-responsive">
            <table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse;">
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
                <?php if (empty($defects)): ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Нет данных</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($defects as $defect): ?>
                        <tr>
                            <td><?= htmlspecialchars($defect['id']) ?></td>
                            <td><?= htmlspecialchars($defect['network_label'] ?? $defect['point_label'] ?? '—') ?></td>
                            <td><?= htmlspecialchars($defect['category'] ?? '—') ?></td>
                            <td>
                                <span class="badge <?= $defect['severity'] == 'high' ? 'badge-high' : ($defect['severity'] == 'medium' ? 'badge-medium' : 'badge-low') ?>">
                                    <?= htmlspecialchars($defect['severity'] ?? '—') ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge <?= $defect['status'] == 'open' ? 'badge-open' : ($defect['status'] == 'in_progress' ? 'badge-in_progress' : 'badge-closed') ?>">
                                    <?= htmlspecialchars($defect['status'] ?? '—') ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php include '../views/layouts/footer.php'; ?>