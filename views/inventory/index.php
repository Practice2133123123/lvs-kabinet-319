<?php include __DIR__ . '/../../views/layouts/header.php'; ?>

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px;">Точка успешно обновлена!</div>
<?php endif; ?>

<?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
    <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px;">Точка успешно удалена!</div>
<?php endif; ?>

    <h1>Сетевые точки</h1>

    <p><a href="point_add.php">+ Добавить точку</a></p>

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

<?php if (empty($points)): ?>
    <p>Нет точек.</p>
<?php else: ?>
    <table border="1" cellpadding="10" width="100%" style="border-collapse: collapse;">
        <tr style="background: #f0f0f0;">
            <th>Метка</th>
            <th>Тип</th>
            <th>Расположение</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($points as $point): ?>
            <tr>
                <td><?= htmlspecialchars($point['label']) ?></td>
                <td><?= htmlspecialchars($point['type']) ?></td>
                <td><?= htmlspecialchars($point['location'] ?? '—') ?></td>
                <td><?= htmlspecialchars($point['status']) ?></td>
                <td>
                    <a href="point_edit.php?id=<?= $point['id'] ?>">Ред.</a> |
                    <a href="point_delete.php?id=<?= $point['id'] ?>" onclick="return confirm('Удалить точку?')">Удал.</a>
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