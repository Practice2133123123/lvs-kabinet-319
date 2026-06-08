<?php include __DIR__ . '/../../views/layouts/header.php'; ?>

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px;">Точка успешно обновлена!</div>
<?php endif; ?>

<?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
    <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px;">Точка успешно удалена!</div>
<?php endif; ?>

    <h1>Сетевые точки</h1>

    <p><a href="point_add.php">+ Добавить точку</a></p>

<?php include __DIR__ . '/summary.php'; ?>

    <div style="margin-bottom: 20px;">
        <button onclick="toggleFilters()" style="padding: 8px 16px; cursor: pointer;">Фильтры</button>
    </div>

    <div id="filterPanel" style="display: none; margin-bottom: 20px; padding: 20px; border: 1px solid #ddd; background: #f9f9f9; border-radius: 8px;">
        <form method="GET">
            <div style="margin-bottom: 15px;">
                <label style="display: inline-block; width: 100px;">Тип точки:</label>
                <select name="type" style="padding: 6px 12px; width: 200px;">
                    <option value="">Все</option>
                    <option value="розетка" <?= isset($_GET['type']) && $_GET['type'] == 'розетка' ? 'selected' : '' ?>>Розетка</option>
                    <option value="коммутатор" <?= isset($_GET['type']) && $_GET['type'] == 'коммутатор' ? 'selected' : '' ?>>Коммутатор</option>
                    <option value="кабель" <?= isset($_GET['type']) && $_GET['type'] == 'кабель' ? 'selected' : '' ?>>Кабель</option>
                    <option value="патч-корд" <?= isset($_GET['type']) && $_GET['type'] == 'патч-корд' ? 'selected' : '' ?>>Патч-корд</option>
                </select>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: inline-block; width: 100px;">Статус:</label>
                <select name="status" style="padding: 6px 12px; width: 200px;">
                    <option value="">Все</option>
                    <option value="активна" <?= isset($_GET['status']) && $_GET['status'] == 'активна' ? 'selected' : '' ?>>Активна</option>
                    <option value="дефект" <?= isset($_GET['status']) && $_GET['status'] == 'дефект' ? 'selected' : '' ?>>Дефект</option>
                    <option value="списана" <?= isset($_GET['status']) && $_GET['status'] == 'списана' ? 'selected' : '' ?>>Списана</option>
                </select>
            </div>
            <div>
                <button type="submit" style="padding: 6px 16px; cursor: pointer;">Применить</button>
                <a href="inventory.php" style="margin-left: 10px;">Сбросить</a>
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

<?php if (empty($points)): ?>
    <p>Нет точек.</p>
<?php else: ?>
    <table border="1" cellpadding="10" width="100%" style="border-collapse: collapse;">
        <tr style="background: #f0f0f0;">
            <th>Метка</th>
            <th>Тип</th>
            <th>Расположение</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($points as $point): ?>
            <tr>
                <td><?= htmlspecialchars($point['label']) ?></td>
                <td><?= htmlspecialchars($point['type']) ?></td>
                <td><?= htmlspecialchars($point['location'] ?? '—') ?></td>
                <td><?= htmlspecialchars($point['status']) ?></td>
                <td>
                    <a href="point_edit.php?id=<?= $point['id'] ?>">Ред.</a> |
                    <a href="point_delete.php?id=<?= $point['id'] ?>" onclick="return confirm('Удалить точку?')">Удал.</a>
                </td>
            </tr>
        <?php endforeach; ?>
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

<?php include __DIR__ . '/../../views/layouts/footer.php'; ?>