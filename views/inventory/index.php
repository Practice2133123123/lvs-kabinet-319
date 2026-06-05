
<?php include '../views/layouts/header.php'; ?>
>>>>>>> Stashed changes
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
                <?php if (count($pagination['items']) > 0): ?>
                    <?php foreach ($pagination['items'] as $point): ?>
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


    <div style="margin-top: 20px;">
<?php
$networkPoints = $pagination['items'];
$total_pages = $pagination['total_pages'];
$current_page = $pagination['current_page'];
if ($current_page > 1) {
    $prev = $current_page - 1;
    echo "<a href='?page=$prev' style='margin-right: 10px;'>&laquo; Назад</a>";
}

for ($i = 1; $i <= $total_pages; $i++) {
    
    if ($i == $current_page) {
        echo "<strong style='margin-right: 10px; color: red;'>$i</strong>";
    } else {
        echo "<a href='?page=$i' style='margin-right: 10px;'>$i</a>";
    }
}

if ($current_page < $total_pages) {
    $next = $current_page + 1;
    echo "<a href='?page=$next'>Вперед &raquo;</a>";
}
?>
</div>

    <script>
        function toggleFilter() {
            var menu = document.getElementById('filterMenu');
            if (menu.style.display === 'none') {
                menu.style.display = 'block';
            } else {
                menu.style.display = 'none';
            }
        }
    </script>

>>>>>>> Stashed changes
<?php include '../views/layouts/footer.php'; ?>