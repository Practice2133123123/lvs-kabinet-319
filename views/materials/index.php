<?php include '../views/layouts/header.php'; ?>

    <h2>Журнал расходов материалов</h2>

    <p>
        <a href="materials_add.php">+ Добавить новый расход</a>
    </p>

    <hr>

    <h2>Фильтры</h2>

    <form method="GET">
        <table border="0">
            <tr>
                <td><label>Дата с:</label></td>
                <td><input type="date" name="date_from" value="<?= htmlspecialchars($date_from) ?>"></td>
                <td width="20"></td>
                <td><label>Дата по:</label></td>
                <td><input type="date" name="date_to" value="<?= htmlspecialchars($date_to) ?>"></td>
            </tr>
            <tr>
                <td><label>Материал:</label></td>
                <td colspan="4">
                    <select name="material_id">
                        <option value="">Все материалы</option>
                        <?php foreach ($materialsList as $m): ?>
                            <option value="<?= $m['id'] ?>" <?= $material_id == $m['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($m['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <br>
                    <button type="submit">Применить фильтры</button>
                    &nbsp;&nbsp;
                    <a href="materials.php">Сбросить все фильтры</a>
                </td>
            </tr>
        </table>
    </form>

    <hr>

    <h2>Сводная информация</h2>

    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <tr bgcolor="#f0f0f0">
            <th width="33%">Общий расход кабеля</th>
            <th width="33%">Количество коннекторов</th>
            <th width="33%">Количество розеток</th>
        </tr>
        <tr>
            <td align="center"><strong><?= number_format($total_cable, 2) ?> м</strong></td>
            <td align="center"><strong><?= number_format($total_connectors) ?> шт</strong></td>
            <td align="center"><strong><?= number_format($total_sockets) ?> шт</strong></td>
        </tr>
    </table>

    <hr>

<?php if (empty($items)): ?>
    <p><strong>Нет данных по выбранным фильтрам</strong></p>
<?php else: ?>
    <table border="1" cellpadding="8" cellspacing="0" width="100%">
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

    <br>

<?php include '../views/layouts/footer.php'; ?>