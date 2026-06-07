<?php 
include __DIR__ . '/../../views/layouts/header.php'; 
?>

        <!-- Собщение об успешном обновлении для пользователя -->
<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <p style="color: green;">Точка успешно обновлена!</p>
<?php endif; ?>
    <h2>Сетевые точки</h2>
<?php include 'summary.php'; ?>

    <p><a href="point_add.php">+ Добавить новую сетевую точку</a></p>
<?php include 'filter.php'; ?>

        <!-- Таблица -->

<?php if (empty($points)): ?>
    <p>Нет данных</p>
<?php else: ?>
    <table border="1" cellpadding="8" style="width:100%; border-collapse: collapse;">
        <thead style="background: #f0f0f0;">
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
                <td><?= htmlspecialchars($point['label']) ?></td>
                <td><?= htmlspecialchars($point['type']) ?></td>
                <td><?= htmlspecialchars($point['location'] ?? '—') ?></td>
                <td><?= htmlspecialchars($point['status']) ?></td>
                <td>
                    <a href="point_edit.php?id=<?= $point['id'] ?>">✏️ Ред.</a>
                    <a href="point_delete.php?id=<?= $point['id'] ?>" onclick="return confirm('Удалить точку?')">🗑 Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

    <!-- Пагинация -->
<?php if ($totalPages > 1): ?>
    <div style="margin-top: 20px; text-align: center;">
        <?php if ($currentPage > 1): ?>
            <a href="?page=<?= $currentPage - 1 ?>">◀ Назад</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php if ($i == $currentPage): ?>
                <strong style="margin: 0 5px; color: red;"><?= $i ?></strong>
            <?php else: ?>
                <a href="?page=<?= $i ?>" style="margin: 0 5px;"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>">Вперёд ▶</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../../views/layouts/footer.php'; ?>