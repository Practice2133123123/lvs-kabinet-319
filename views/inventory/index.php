<?php include __DIR__ . '/../../views/layouts/header.php'; ?>

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div class="alert alert-success">Точка успешно обновлена!</div>
<?php endif; ?>

<?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
    <div class="alert alert-success">Точка успешно удалена!</div>
<?php endif; ?>

    <h1>Сетевые точки</h1>
<?php if (isLoggedIn()):?>
    <p><a href="point_add.php" class="btn btn-primary">+ Добавить точку</a></p>
<?php endif;?>
<?php include __DIR__ . '/summary.php'; ?>
<?php include __DIR__ . '/filter.php'; ?>

<?php if (empty($points)): ?>
    <div class="empty-state">Нет точек.</div>
<?php else: ?>
    <table>
        <thead>
        <tr>
            <th>Метка</th>
            <th>Тип</th>
            <th>Расположение</th>
            <th>Статус</th>
            <?php if (isLoggedIn()):?>
            <th>Действия</th>
            <?php endif;?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($points as $point): ?>
            <tr>
                <td><?= htmlspecialchars($point['label']) ?></td>
                <td><?= htmlspecialchars($point['type']) ?></td>
                <td><?= htmlspecialchars($point['location'] ?? '—') ?></td>
                <td><?= htmlspecialchars($point['status']) ?></td>
                <?php if (isLoggedIn()):?>
                <td>
                    <a href="point_edit.php?id=<?= $point['id'] ?>" class="btn-action btn-action-edit">Ред.</a>
                    <a href="point_delete.php?id=<?= $point['id'] ?>" class="btn-action btn-action-delete" onclick="return confirm('Удалить точку?')">Удал.</a>
                </td>
                <?php endif;?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php if ($totalPages > 1): ?>
    <div class="pagination-links">
        <?php if ($currentPage > 1): ?>
            <?php 
                $params = $_GET;
                $params['page'] = $currentPage - 1;
                $linkBack = "?" . http_build_query($params); ?>
            <a href="<?= $linkBack ?>">← Назад</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php 
                $params = $_GET;
                $params['page'] = $i;
                $linkPage = "?" . http_build_query($params); ?>
            <?php if ($i == $currentPage): ?>
                <strong><?= $i ?></strong>
            <?php else: ?>
                <a href="<?= $linkPage?>"><?= $i ?></a>
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
