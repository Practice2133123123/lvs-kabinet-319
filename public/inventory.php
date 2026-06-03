<?php
require_once('../config/db.php');
//Вывод всех данных из таблицы network_points
$stmt = $pdo ->query("SELECT * FROM `network_points` ORDER BY last_check DESC ");
$stmt -> execute();
$networkPoints = $stmt ->fetchAll(PDO::FETCH_ASSOC);

require '../includes/header.php';
?>

<div class="container">
    <h1 class="mb-4">Сетевые точки</h1>

    <!-- Таблица сетевых точек -->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Метка</th>
                    <th>Тип</th>
                    <th>Расположение</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($networkPoints) > 0): ?>
                    <?php foreach ($networkPoints as $point): ?>
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
                                $statusColors = [
                                'active' => 'success',
                                'defect' => 'danger',
                                'decommissioned' => 'secondary'
                                ];
                                $statusLabels = [
                                'active' => 'Активна',
                                'defect' => 'Дефект',
                                'decommissioned' => 'Списана'
                                ];
                                $color = $statusColors[$point['status']] ?? 'secondary';
                                $label = $statusLabels[$point['status']] ?? $point['status'];
                                ?>
                                <span class="badge bg-<?= $color ?> px-3 py-2">
                                    <?= htmlspecialchars($label) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    //Если в таблице нет данных
                <!-- <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">
                            Нет данных
                        </td>
                    </tr>
                <?php endif; ?> -->
            </tbody>
        </table>
    </div>
</div>

<?php require '../includes/footer.php'; ?>

    <?php '../includes/footer.php'; 
    ?>
