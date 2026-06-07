<?php 
include __DIR__ . '/../../views/layouts/header.php'; 
?>

        <!-- Собщение об успешном обновлении для пользователя -->
<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <p style="color: green;">Точка успешно обновлена!</p>
<?php endif; ?>
    <h2>Сетевые точки</h2>
<?php include 'summary.php'; ?>
<?php include 'filter.php'; ?>

        <!-- Таблица -->

<?php if (empty($points)): ?>
    <div class="alert alert-info">Нет точек. <a href="point_add.php">Добавить →</a></div>
<?php else: ?>
    <table>
        <thead>
        <tr>
            <th>Метка</th>
            <th>Тип</th>
            <th>Расположение</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($points as $point): ?>
            <tr>
                <td><strong><?= htmlspecialchars($point['label']) ?></strong></td>
                <td><?= htmlspecialchars($point['type']) ?></td>
                <td><small><?= htmlspecialchars($point['location'] ?? '—') ?></small></td>
                <td>
                    <?php 
                        $status = htmlspecialchars($point['status']);
                        $statusClass = strtolower($status);
                    ?>
                    <span class="status-badge status-<?= $statusClass ?>"><?= $status ?></span>
                </td>
                <td>
                    <a href="point_edit.php?id=<?= $point['id'] ?>" class="btn btn-secondary" style="padding: 5px 10px; font-size: 12px;">Ред.</a>
                    <a href="point_delete.php?id=<?= $point['id'] ?>" class="btn btn-danger" style="padding: 5px 10px; font-size: 12px;" onclick="return confirm('Вы уверены?')">Удал.</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

    <!-- Пагинация -->
<?php if ($totalPages > 1): ?>
    <div class="pagination">
        <?php if ($currentPage > 1): ?>
            <a href="?page=<?= $currentPage - 1 ?>">Назад</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php if ($i == $currentPage): ?>
                <span class="active"><?= $i ?></span>
            <?php else: ?>
                <a href="?page=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>">Вперёд</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<<<<<<< HEAD
<?php include __DIR__ . '/../layouts/footer.php'; ?>
=======
<?php include __DIR__ . '/../../views/layouts/footer.php'; ?>
>>>>>>> mirzhan
