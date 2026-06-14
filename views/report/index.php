<?php include __DIR__ . '/../layouts/header.php'; ?>
    <div class="no-print">
        <h1>Отчёты по расходу материалов</h1>
    </div>

    <div class="filter-dropdown no-print">
        <button class="btn btn-secondary" onclick="toggleFilter('rptFilter')">Фильтры</button>
        <div id="rptFilter" class="filter-menu hidden">
            <form method="GET">
                <div class="filter-group">
                    <label>Дата с:</label>
                    <input type="date" name="date_from" value="<?= htmlspecialchars($_GET['date_from'] ?? '') ?>">
                </div>
                <div class="filter-group">
                    <label>Дата по:</label>
                    <input type="date" name="date_to" value="<?= htmlspecialchars($_GET['date_to'] ?? '') ?>">
                </div>
                <div class="filter-group">
                    <label>Раздел:</label>
                    <select name="section">
                        <option value="">Все</option>
                        <option value="point" <?= ($_GET['section'] ?? '') == 'point' ? 'selected' : '' ?>>Точки</option>
                        <option value="defect" <?= ($_GET['section'] ?? '') == 'defect' ? 'selected' : '' ?>>Дефекты</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Тип материала:</label>
                    <select name="type">
                        <option value="">Все</option>
                        <?php foreach ($materialTypes as $type): ?>
                            <option value="<?= htmlspecialchars($type['type']) ?>" <?= ($_GET['type'] ?? '') == $type['type'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($type['type']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Статус точки:</label>
                    <select name="point_status">
                        <option value="">Все</option>
                        <?php foreach ($pointStatuses as $status): ?>
                            <option value="<?= htmlspecialchars($status['value']) ?>" <?= ($_GET['point_status'] ?? '') == $status['value'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($status['label']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Статус дефекта:</label>
                    <select name="defect_status">
                        <option value="">Все</option>
                        <?php foreach ($defectStatuses as $status): ?>
                            <option value="<?= htmlspecialchars($status['value']) ?>" <?= ($_GET['defect_status'] ?? '') == $status['value'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($status['label']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <button type="submit" class="btn btn-primary">Применить</button>
                    <a href="report.php" class="btn btn-secondary" style="margin-left: 8px;">Сбросить</a>
                </div>
            </form>
        </div>
    </div>

    <div class="no-print" style="margin: 20px 0;">
        <button class="btn btn-secondary" onclick="window.print()">Печать</button>
        <a href="?<?= http_build_query(array_merge($_GET, ['export' => 'csv'])) ?>" class="btn btn-secondary" style="margin-left: 8px;">Экспорт CSV</a>
    </div>

    <hr>

<?php if (empty($data)): ?>
    <div class="empty-state">Нет записей по выбранным фильтрам</div>
<?php else: ?>
    <table>
        <thead>
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
    <div class="pagination-links">
        <?php if ($currentPage > 1): ?>
            <a href="?page=<?= $currentPage - 1 ?>">← Назад</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php if ($i == $currentPage): ?>
                <strong><?= $i ?></strong>
            <?php else: ?>
                <a href="?page=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>">Вперёд →</a>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
