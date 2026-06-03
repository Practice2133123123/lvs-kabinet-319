<?php
// Подключаем конфиг БД и функции
require_once '../config/db.php';
require_once '../includes/functions.php';

// Получаем все сетевые точки
$networkPoints = getNetworkPoints($pdo);

require '../layouts/header.php';
?>

<div class="container mt-4">
    <h1 class="mb-4">Сетевые точки</h1>

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
                            </td>
                        </tr>
                    <?php endforeach; ?>
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

<?php require '../layouts/footer.php'; ?>
