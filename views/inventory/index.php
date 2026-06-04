<?php 
include '../views/layouts/header.php'; 
?>

    <div class="container mt-4">
        <h1 class="mb-4">Сетевые точки</h1>
        <!-- Собщение об успешном обновлении для пользователя -->
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

<?php include '../views/layouts/footer.php'; ?>