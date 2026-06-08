<?php include __DIR__ . '/../layouts/header.php'; ?>
        <div class="no-print">
    <h1>Отчёты по расходу материалов</h1>
        </div>

    <div style="margin-bottom: 20px;">
        <button onclick="toggleFilters()" style="padding: 8px 16px; cursor: pointer;">Фильтры</button>
    </div>

    <div id="filterPanel" style="display: none; margin-bottom: 20px; padding: 20px; border: 1px solid #ddd; background: #f9f9f9; border-radius: 8px;">
        
        <form method="GET">
            <div style="margin-bottom: 15px;">
                <label style="display: inline-block; width: 120px;">Дата с:</label>
                <input type="date" name="date_from" value="<?= htmlspecialchars($_GET['date_from'] ?? '') ?>" style="padding: 6px 12px; width: 200px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: inline-block; width: 120px;">Дата по:</label>
                <input type="date" name="date_to" value="<?= htmlspecialchars($_GET['date_to'] ?? '') ?>" style="padding: 6px 12px; width: 200px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: inline-block; width: 120px;">Раздел:</label>
                <select name="section" style="padding: 6px 12px; width: 200px;">
                    <option value="">Все</option>
                    <option value="point" <?= ($_GET['section'] ?? '') == 'point' ? 'selected' : '' ?>>Точки</option>
                    <option value="defect" <?= ($_GET['section'] ?? '') == 'defect' ? 'selected' : '' ?>>Дефекты</option>
                </select>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: inline-block; width: 120px;">Тип материала:</label>
                <select name="type" style="padding: 6px 12px; width: 200px;">
                    <option value="">Все</option>
                    <?php foreach ($materialTypes as $type): ?>
                        <option value="<?= htmlspecialchars($type['type']) ?>" <?= ($_GET['type'] ?? '') == $type['type'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($type['type']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: inline-block; width: 120px;">Статус точки:</label>
                <select name="point_status" style="padding: 6px 12px; width: 200px;">
                    <option value="">Все</option>
                    <?php foreach ($pointStatuses as $status): ?>
                        <option value="<?= htmlspecialchars($status['value']) ?>" <?= ($_GET['point_status'] ?? '') == $status['value'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($status['label']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: inline-block; width: 120px;">Статус дефекта:</label>
                <select name="defect_status" style="padding: 6px 12px; width: 200px;">
                    <option value="">Все</option>
                    <?php foreach ($defectStatuses as $status): ?>
                        <option value="<?= htmlspecialchars($status['value']) ?>" <?= ($_GET['defect_status'] ?? '') == $status['value'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($status['label']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <button type="submit" style="padding: 6px 16px; cursor: pointer;">Применить</button>
                <a href="report.php" style="margin-left: 10px;">Сбросить</a>
            </div>
        </form>
    </div>

    <script>
        function toggleFilters() {
            var panel = document.getElementById('filterPanel');
            if (panel.style.display === 'none') {
                panel.style.display = 'block';
            } else {
                panel.style.display = 'none';
            }
        }
    </script>

    <div style="margin: 20px 0;">
        <button onclick="window.print()" style="padding: 6px 16px; cursor: pointer;">Печать</button>
        <a href="?<?= http_build_query(array_merge($_GET, ['export' => 'csv'])) ?>" style="margin-left: 10px;">Экспорт CSV</a>
    </div>

    <hr>

<?php if (empty($data)): ?>
    <p>Нет записей по выбранным фильтрам</p>
<?php else: ?>
    <table border="1" cellpadding="10" width="100%" style="border-collapse: collapse;">
        <thead style="background: #f0f0f0;">
        <tr>
            <th>ID</th>
            <th>Материал</th>
            <th>Количество</th>
            <th>Дата</th>
            <th>Комментарий</th>
            <th>Раздел</th>
            <th>Точка/Дефект</th>
            <th>Пользователь</th>
            <th>Статус точки</th>
            <th>Статус дефекта</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['material_name']) ?></td>
                <td><?= htmlspecialchars($row['quantity']) ?></td>
                <td><?= htmlspecialchars($row['used_at']) ?></td>
                <td><?= htmlspecialchars($row['comment'] ?? '-') ?></td>
                <td><?= htmlspecialchars($row['section']) ?></td>
                <td><?= htmlspecialchars($row['section_name'] ?? '-') ?></td>
                <td><?= htmlspecialchars($row['user_name'] ?? '-') ?></td>
                <td><?= htmlspecialchars($row['point_status'] ?? '-') ?></td>
                <td><?= htmlspecialchars($row['defect_status'] ?? '-') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php if ($totalPages > 1): ?>
    <div style="margin-top: 20px; text-align: center;">
        <?php if ($currentPage > 1): ?>
            <a href="?page=<?= $currentPage - 1 ?>">← Назад</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php if ($i == $currentPage): ?>
                <strong style="margin: 0 5px;"><?= $i ?></strong>
            <?php else: ?>
                <a href="?page=<?= $i ?>" style="margin: 0 5px;"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>">Вперёд →</a>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php include __DIR__ . '/../layouts/footer.php'; ?>