<?php include __DIR__ . '/../../views/layouts/header.php'; ?>

    <h1>Журнал расходов материалов</h1>

    <p><a href="materials_add.php" class="btn btn-primary">+ Добавить расход</a></p>

<?php include __DIR__ . '/summary.php'; ?>
<?php include __DIR__ . '/filter.php'; ?>

<?php if (empty($items)): ?>
    <div class="empty-state">Нет записей.</div>
<?php else: ?>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Материал</th>
            <th>Количество</th>
            <th>Ед.изм.</th>
            <th>Точка</th>
            <th>Кто использовал</th>
            <th>Дата</th>
            <th>Комментарий</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['id']) ?></td>
                <td><?= htmlspecialchars($item['material_name']) ?></td>
                <td><?= htmlspecialchars($item['quantity']) ?></td>
                <td><?= $item['unit'] == 'м' ? 'м' : 'шт' ?></td>
                <td><?= htmlspecialchars($item['point_label'] ?? '—') ?></td>
                <td><?= htmlspecialchars($item['user_name'] ?? '—') ?></td>
                <td><?= htmlspecialchars($item['used_at']) ?></td>
                <td><?= htmlspecialchars($item['comment'] ?? '—') ?></td>
                <td>
                    <a href="material_edit.php?id=<?= $item['id'] ?>" class="btn-action btn-action-edit">Ред.</a>
                    <a href="material_delete.php?id=<?= $item['id'] ?>" class="btn-action btn-action-delete" onclick="return confirm('Удалить запись?')">Удал.</a>
                </td>
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
