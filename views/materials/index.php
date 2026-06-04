<?php include '../views/layouts/header.php'; ?>

    <h2>Фильтры</h2>

    <form method="GET">
        <label>Дата с:</label>
        <input type="date" name="date_from" value="<?= htmlspecialchars($date_from) ?>">

        <label>Дата по:</label>
        <input type="date" name="date_to" value="<?= htmlspecialchars($date_to) ?>">

        <label>Материал:</label>
        <select name="material_id">
            <option value="">Все</option>
            <?php foreach ($materialsList as $m): ?>
                <option value="<?= $m['id'] ?>" <?= $material_id == $m['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($m['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Применить</button>
        <a href="materials.php">Сбросить</a>
    </form>

    <hr>

    <h3>Сводка</h3>
    <p>Общий расход кабеля: <strong><?= number_format($total_cable, 2) ?> м</strong></p>
    <p>Количество коннекторов: <strong><?= number_format($total_connectors) ?> шт</strong></p>
    <p>Количество розеток: <strong><?= number_format($total_sockets) ?> шт</strong></p>

    <hr>

    <h3>Журнал расходов материалов</h3>

<?php if (empty($items)): ?>
    <p>Нет данных</p>
<?php else: ?>
    <table border="1">
        <thead>
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
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['id']) ?></td>
                <td><?= htmlspecialchars($item['material_name']) ?></td>
                <td><?= htmlspecialchars($item['quantity']) ?></td>
                <td><?= $item['material_type'] == 'cable' ? 'м' : 'шт' ?></td>
                <td><?= htmlspecialchars($item['point_label'] ?? '—') ?></td>
                <td><?= htmlspecialchars($item['user_name'] ?? '—') ?></td>
                <td><?= htmlspecialchars($item['used_at']) ?></td>
                <td><?= htmlspecialchars($item['comment'] ?? '—') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

    <p>
        <a href="materials_add.php">Добавить расход</a>
    </p>

<?php include '../views/layouts/footer.php'; ?>