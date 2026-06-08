<?php include __DIR__ . '/../../views/layouts/header.php'; ?>

    <h1>Дефекты</h1>

    <p><a href="defect_add.php">+ Добавить дефект</a></p>

<?php include __DIR__ . '/summary.php'; ?>
<?php include __DIR__ . '/filter.php'; ?>


    <script>
        function toggleFilters() {
            var panel = document.getElementById('filterPanel');
            if (panel.style.display === 'none') {
                panel.style.display = 'block';
            } else {
                panel.style.display = 'none';
            }
        }
    </script>

<?php if (empty($defects)): ?>
    <p>Нет дефектов.</p>
<?php else: ?>
    <table border="1" cellpadding="10" width="100%" style="border-collapse: collapse;">
        <tr style="background: #f0f0f0;">
            <th>ID</th>
            <th>Точка</th>
            <th>Категория</th>
            <th>Критичность</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($defects as $defect): ?>
            <tr>
                <td><?= htmlspecialchars($defect['id']) ?></td>
                <td><?= htmlspecialchars($defect['point_label'] ?? '—') ?></td>
                <td><?= htmlspecialchars($defect['category'] ?? '—') ?></td>
                <td><?= htmlspecialchars($defect['severity'] ?? '—') ?></td>
                <td><?= htmlspecialchars($defect['status'] ?? '—') ?></td>
                <td>
                    <a href="defect_edit.php?id=<?= $defect['id'] ?>">Ред.</a> |
                    <a href="defect_delete.php?id=<?= $defect['id'] ?>" onclick="return confirm('Удалить дефект?')">Удал.</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?php if ($totalPages > 1): ?>
    <div style="margin-top: 20px; text-align: center;">
        <?php if ($currentPage > 1): ?>
            <?php 
                $params = $_GET;
                $params['page'] = $currentPage - 1;
                $linkBack = "?" . http_build_query($params); ?>
            <a href="?page=<?= $linkBack ?>">← Назад</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php 
                $params = $_GET;
                $params['page'] = $i;
                $linkPage = "?" . http_build_query($params); ?>
            <?php if ($i == $currentPage): ?>
                <strong style="margin: 0 5px;"><?= $i ?></strong>
            <?php else: ?>
                <a href="<?= $linkPage?>" style="margin: 0 5px;"><?= $i ?></a>
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