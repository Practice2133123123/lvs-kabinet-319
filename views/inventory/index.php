<?php 
include '../views/layouts/header.php'; 
?>

<<<<<<< HEAD
    <div class="container mt-4">
        <h1 class="mb-4">Сетевые точки</h1>
        <!-- Собщение об успешном обновлении для пользователя -->
<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <p style="color: green;">Точка успешно обновлена!</p>
<?php endif; ?>
<?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
        <p style="color: green;">Точка успешно удалена!</p>
<?php endif; ?>
    
<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <p style="color: green;">Точка успешно обновлена!</p>
<?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">

                
                <tr>
                    <th>Метка</th>
                    <th>Тип</th>
                    <th>Расположение</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                <?php if (count($points) > 0): ?>
                    <?php foreach ($points as $point): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($point['label']) ?></strong></td>
                            <td>
                                <?php
                                $typeLabels = [
                                        'socket' => 'Розетка',
                                        'switch' => 'Коммутатор',
                                        'cable_run' => 'Кабель',
                                        'patch_cord' => 'Патч-корд'
                                ];
                                $typeName = $typeLabels[$point['type']] ?? $point['type'];
                                echo htmlspecialchars($typeName);
                                ?>
                            </td>
                            <td><?= htmlspecialchars($point['location'] ?? '—') ?></td>
                            <td>
                                <?php
                                $statusLabels = [
                                        'active' => 'Активна',
                                        'defect' => 'Дефект',
                                        'decommissioned' => 'Списана'
                                ];
                                $label = $statusLabels[$point['status']] ?? $point['status'];
                                ?>
                                <span class="badge status-<?= htmlspecialchars($point['status']) ?>">
                                    <?= htmlspecialchars($label) ?>
                                </span>
                                <td><?= htmlspecialchars($point['created_by_name'] ?? '—') ?></td>
                                <td> <a href="point_edit.php?id=<?= $point['id'] ?>">Изменить точку</a>
                            <a href="point_delete.php?id=<?= $point['id'] ?>"onclick="return confirm('Удалить точку «<?= htmlspecialchars($point['label']) ?>»');">Удалить
            </a>
                            </td>
                                
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">
                            Нет данных
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">
        <a href="point_add.php" class="btn btn-primary">Добавить точку</a>
    </div>
</div>
=======
    <h2>Сетевые точки</h2>
<?php include 'summary.php'; ?>

    <p><a href="point_add.php">+ Добавить новую сетевую точку</a></p>
<?php include 'filter.php'; ?>

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
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0

<?php include '../views/layouts/footer.php'; ?>