<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отчёты</title>
</head>
<body>

<div class="no-print">
    <h1>Отчёты по расходу материалов</h1>
    
    <form method="GET" action="">
        <input type="date" name="date_from" placeholder="Дата с" value="<?= htmlspecialchars($_GET['date_from'] ?? '') ?>">
        <input type="date" name="date_to" placeholder="Дата по" value="<?= htmlspecialchars($_GET['date_to'] ?? '') ?>">
        
        <select name="material_type">
            <option value="">Все типы материалов</option>
            <?php foreach ($materialTypes as $type): ?>
                <option value="<?= htmlspecialchars($type['type']) ?>" <?= ($_GET['material_type'] ?? '') == $type['type'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($type['type']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <select name="section">
            <option value="">Все разделы</option>
            <?php foreach ($sections as $section): ?>
                <option value="<?= htmlspecialchars($section['section']) ?>" <?= ($_GET['section'] ?? '') == $section['section'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($section['label']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <select name="status">
            <option value="">Все статусы</option>
            <?php foreach ($statuses as $status): ?>
                <option value="<?= htmlspecialchars($status['status']) ?>" <?= ($_GET['status'] ?? '') == $status['status'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($status['label']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit">Применить фильтры</button>
        <a href="report.php">Сбросить</a>
    </form>
    
    <div>
        <button onclick="window.print()">🖨 Печать</button>
        <a href="?<?= http_build_query(array_merge($_GET, ['export' => 'csv'])) ?>">📥 Экспорт CSV</a>
    </div>
    
    <hr>
    <h2>Результаты</h2>
</div>

<?php if (empty($data)): ?>
    <p>Нет записей по выбранным фильтрам</p>
<?php else: ?>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Материал</th>
                <th>Количество</th>
                <th>Дата</th>
                <th>Комментарий</th>
                <th>Точка</th>
                <th>Дефект</th>
                <th>Пользователь</th>
                <th>Статус</th>
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
                <td><?= htmlspecialchars($row['point_label'] ?? '-') ?></td>
                <td><?= htmlspecialchars($row['defect_description'] ?? '-') ?></td>
                <td><?= htmlspecialchars($row['user_name'] ?? '-') ?></td>
                <td><?= htmlspecialchars($row['status'] ?? '-') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>