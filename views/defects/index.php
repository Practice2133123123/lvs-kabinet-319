<?php include '../views/layouts/header.php'; ?>

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

                <?php if (empty($pagination['items'])): ?>

                    <tr>
                        <td colspan="5" style="text-align: center;">Нет данных</td>
                    </tr>
                <?php else: ?>

                    <?php foreach ($pagination['items'] as $defect): ?>

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

<<<<<<< HEAD

    <div style="margin-top: 20px;">
<?php
$defects = $pagination['items'];
$total_pages = $pagination['total_pages'];
$current_page = $pagination['current_page'];
if ($current_page > 1) {
    $prev = $current_page - 1;
    echo "<a href='?page=$prev' style='margin-right: 10px;'>&laquo; Назад</a>";
}

for ($i = 1; $i <= $total_pages; $i++) {
    
    if ($i == $current_page) {
        echo "<strong style='margin-right: 10px; color: red;'>$i</strong>";
    } else {
        echo "<a href='?page=$i' style='margin-right: 10px;'>$i</a>";
    }
}

if ($current_page < $total_pages) {
    $next = $current_page + 1;
    echo "<a href='?page=$next'>Вперед &raquo;</a>";
}
?>
</div>
<?php include '../views/layouts/footer.php'; ?>