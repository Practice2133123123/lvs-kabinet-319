<?php 
require_once __DIR__ . '/../../views/layouts/header.php'
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отчёты</title>
</head>
<body>

<div class="no-print">
    <h1>Отчёты по расходу материалов</h1>
    <a href="/public/index.php">На главную страницу</a>
    <form method="GET" action="">
        <input type="date" name="date_from" placeholder="Дата с" value="<?= htmlspecialchars($_GET['date_from'] ?? '') ?>">
        <input type="date" name="date_to" placeholder="Дата по" value="<?= htmlspecialchars($_GET['date_to'] ?? '') ?>">
        
        <select name="section">
            <option value="">Все разделы</option>
            <?php foreach ($sections as $section): ?>
                <option value="<?= htmlspecialchars($section['value']) ?>" <?= ($_GET['section'] ?? '') == $section['value'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($section['label']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <select name="type">
            <option value="">Все типы материалов</option>
            <?php foreach ($materialTypes as $type): ?>
                <option value="<?= htmlspecialchars($type['type']) ?>" <?= ($_GET['type'] ?? '') == $type['type'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($type['type']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <select name="point_status">
            <option value="">Все статусы точек</option>
            <?php foreach ($pointStatuses as $status): ?>
                <option value="<?= htmlspecialchars($status['value']) ?>" <?= ($_GET['point_status'] ?? '') == $status['value'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($status['label']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <select name="defect_status">
            <option value="">Все статусы дефектов</option>
            <?php foreach ($defectStatuses as $status): ?>
                <option value="<?= htmlspecialchars($status['value']) ?>" <?= ($_GET['defect_status'] ?? '') == $status['value'] ? 'selected' : '' ?>>
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
<?php endif;?>
</body>
</html>
<?php 
// require_once __DIR__ . '/../../views/layouts/footer.php';
include '../../views/layouts/footer.php';
?>