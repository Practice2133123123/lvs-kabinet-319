<?php include '../views/layouts/header.php'; ?>

    <div class="container mt-4">
        <h1 class="mb-4">Журнал расходов материалов</h1>

        <!-- Сводная карточка (теперь сверху) -->
        <?php include __DIR__ . '/summary.php'; ?>

        <!-- Фильтр (под сводкой) -->
        <?php include __DIR__ . '/filter.php'; ?>

        <!-- Таблица -->
        <div class="table-responsive">

            <?php if (empty($pagination['items'])): ?>


                <p>Нет данных</p>
            <?php else: ?>
                <table border="1" cellpadding="8" style="width:100%; border-collapse: collapse;">
                    <thead style="background: #f0f0f0;">
                    <tr>
                        <th>ID</th>
                        <th>Материал</th>
                        <th>Количество</th>
                        <th>Ед.изм.</th>
                        <th>Точка</th>
                        <th>Кто использовал</th>
                        <th>Дата</th>
                        <th>Комментарий</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($pagination['items'] as $item): ?>

                        <tr>
                            <td><?= htmlspecialchars($item['id']) ?></td>
                            <td><?= htmlspecialchars($item['material_name']) ?></td>
                            <td><?= htmlspecialchars($item['quantity']) ?></td>
                            <td><?= $item['unit'] == 'm' ? 'м' : 'шт' ?></td>
                            <td><?= htmlspecialchars($item['point_label'] ?? '—') ?></td>
                            <td><?= htmlspecialchars($item['user_name'] ?? '—') ?></td>
                            <td><?= htmlspecialchars($item['used_at']) ?></td>
                            <td><?= htmlspecialchars($item['comment'] ?? '—') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <div style="margin-top: 20px;">
            <a href="materials_add.php" class="btn btn-primary">➕ Добавить расход</a>
        </div>
    </div>

    <div style="margin-top: 20px;">
<?php
$materials = $pagination['items'];
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

<?php include '../views/layouts/footer.php'; ?>

