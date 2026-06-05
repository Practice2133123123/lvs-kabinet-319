<?php include '../views/layouts/header.php'; ?>

    <h2>Сетевые точки</h2>

    <p>
        <a href="point_add.php">+ Добавить новую сетевую точку</a>
    </p>

    <hr>

    <h2>Фильтры</h2>

    <form method="GET">
        <table border="0">
            <tr>
                <td><label>Тип точки:</label></td>
                <td>
                    <select name="type">
                        <option value="">Все типы</option>
                        <option value="socket" <?= isset($_GET['type']) && $_GET['type'] == 'socket' ? 'selected' : '' ?>>Розетка</option>
                        <option value="switch" <?= isset($_GET['type']) && $_GET['type'] == 'switch' ? 'selected' : '' ?>>Коммутатор</option>
                        <option value="cable_run" <?= isset($_GET['type']) && $_GET['type'] == 'cable_run' ? 'selected' : '' ?>>Кабель</option>
                        <option value="patch_cord" <?= isset($_GET['type']) && $_GET['type'] == 'patch_cord' ? 'selected' : '' ?>>Патч-корд</option>
                    </select>
                </td>
                <td width="20"></td>
                <td><label>Статус:</label></td>
                <td>
                    <select name="status">
                        <option value="">Все статусы</option>
                        <option value="active" <?= isset($_GET['status']) && $_GET['status'] == 'active' ? 'selected' : '' ?>>Активна</option>
                        <option value="defect" <?= isset($_GET['status']) && $_GET['status'] == 'defect' ? 'selected' : '' ?>>Дефект</option>
                        <option value="decommissioned" <?= isset($_GET['status']) && $_GET['status'] == 'decommissioned' ? 'selected' : '' ?>>Списана</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <br>
                    <button type="submit">Применить фильтры</button>
                    &nbsp;&nbsp;
                    <a href="inventory.php">Сбросить все фильтры</a>
                </td>
            </tr>
        </table>
    </form>

    <hr>

<?php if (empty($points)): ?>
    <p><strong>Нет данных по выбранным фильтрам</strong></p>
<?php else: ?>
    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Метка</th>
            <th>Тип</th>
            <th>Расположение</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($points as $point): ?>
            <tr>
                <td><?= htmlspecialchars($point['label']) ?></td>
                <td><?= htmlspecialchars($point['type']) ?></td>
                <td><?= htmlspecialchars($point['location'] ?? '—') ?></td>
                <td><?= htmlspecialchars($point['status']) ?></td>
                <td>
                    <a href="point_edit.php?id=<?= $point['id'] ?>">Редактировать</a>
                    &nbsp;|&nbsp;
                    <a href="point_delete.php?id=<?= $point['id'] ?>" onclick="return confirm('Удалить точку?')">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

    <br>

<?php include '../views/layouts/footer.php'; ?>