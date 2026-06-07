<?php 
include '../views/layouts/header.php'; 
?>

        <h1 class="mb-4">Сетевые точки</h1>
        <!-- Собщение об успешном обновлении для пользователя -->
<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <p style="color: green;">Точка успешно обновлена!</p>
<?php endif; ?>
    <h2>Сетевые точки</h2>
<?php include 'summary.php'; ?>

    <p><a href="point_add.php">+ Добавить новую сетевую точку</a></p>
<?php include 'filter.php'; ?>

        <!-- Таблица -->
        <div class="table-responsive">
            <table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse;">
                <thead style="background: #f0f0f0;">
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
                            <td><?= htmlspecialchars($point['label']) ?></td>
                            <td><?= htmlspecialchars($point['type']) ?></td>
                            <td><?= htmlspecialchars($point['location'] ?? '—') ?></td>
                            <td><?= htmlspecialchars($point['status']) ?></td>
                            <td>

                                <a href="point_edit.php?id=<?= $point['id'] ?>">️ Ред.</a>
                                <a href="point_delete.php?id=<?= $point['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Удалить точку?')">Удалить</a>


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
                                <td> <a href="point_edit.php?id=<?= $point['id'] ?>">Изменить точку</a></td>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Нет данных</td>
                    </tr>
                <?php endif; ?>

            </table>  
            <a href="point_add.php?id=<?= $point['id'] ?>" class="btn btn-sm btn-secondary" >Добавить сетевую точку</a>              
        </tbody>

        </div>

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

<?php include '../views/layouts/footer.php'; ?>