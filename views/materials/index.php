<?php include __DIR__ . '/../../views/layouts/header.php'; ?>

    <h1>Журнал расходов материалов</h1>

    <p><a href="materials_add.php">+ Добавить расход</a></p>

<?php include __DIR__ . '/summary.php'; ?>
<?php include __DIR__ . '/filter.php'; ?>

    <!-- <div style="margin-bottom: 20px;">
        <button onclick="toggleFilters()" style="padding: 8px 16px; cursor: pointer;">Фильтры</button>
    </div>

    <div id="filterPanel" style="display: none; margin-bottom: 20px; padding: 20px; border: 1px solid #ddd; background: #f9f9f9; border-radius: 8px;">
        <form method="GET">
            <div style="margin-bottom: 15px;">
                <label style="display: inline-block; width: 100px;">Дата с:</label>
                <input type="date" name="date_from" value="<?= htmlspecialchars($date_from ?? '') ?>" style="padding: 6px 12px; width: 200px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: inline-block; width: 100px;">Дата по:</label>
                <input type="date" name="date_to" value="<?= htmlspecialchars($date_to ?? '') ?>" style="padding: 6px 12px; width: 200px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: inline-block; width: 100px;">Материал:</label>
                <select name="material_id" style="padding: 6px 12px; width: 200px;">
                    <option value="">Все</option>
                    <?php foreach ($materialsList as $m): ?>
                        <option value="<?= $m['id'] ?>" <?= ($material_id ?? '') == $m['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($m['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <button type="submit" style="padding: 6px 16px; cursor: pointer;">Применить</button>
                <a href="materials.php" style="margin-left: 10px;">Сбросить</a>
            </div>
        </form>
    </div> -->

    <!-- <script>
        function toggleFilters() {
            var panel = document.getElementById('filterPanel');
            if (panel.style.display === 'none') {
                panel.style.display = 'block';
            } else {
                panel.style.display = 'none';
            }
        }
    </script> -->

<?php if (empty($items)): ?>
    <p>Нет записей.</p>
<?php else: ?>
    <table border="1" cellpadding="10" width="100%" style="border-collapse: collapse;">
        <tr style="background: #f0f0f0;">
            <th>ID</th>
            <th>Материал</th>
            <th>Количество</th>
            <th>Ед.изм.</th>
            <th>Точка</th>
            <th>Кто использовал</th>
            <th>Дата</th>
            <th>Комментарий</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($items as $item): ?>

            <tr>
                <td><?= htmlspecialchars($item['id']) ?></td>
                <td><?= htmlspecialchars($item['material_name']) ?></td>
                <td><?= htmlspecialchars($item['quantity']) ?></td>
                <td><?= $item['unit'] == 'м' ? 'м' : 'шт' ?></td>
                <td><?= htmlspecialchars($item['point_label'] ?? '—') ?></td>
                <td><?= htmlspecialchars($item['user_name'] ?? '—') ?></td>
                <td><?= htmlspecialchars($item['used_at']) ?></td>
                <td><?= htmlspecialchars($item['comment'] ?? '—') ?></td>
                <td>
                    <a href="material_edit.php?id=<?= $item['id'] ?>">Ред.</a> |
                    <a href="material_delete.php?id=<?= $item['id'] ?>" onclick="return confirm('Удалить запись?')">Удал.</a>
                </td>
            </tr>

        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?php if ($totalPages > 1): ?>
    <div style="margin-top: 20px; text-align: center;">
        <?php if ($currentPage > 1): ?>
            <?php 
                $params = $_GET;
                $params['page'] = $currentPage - 1;
                $linkBack = "?" . http_build_query($params); ?>
            <a href="<?= $linkBack ?>">← Назад</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php 
                $params = $_GET;
                $params['page'] = $i;
                $linkPage = "?" . http_build_query($params); ?>
            <?php if ($i == $currentPage): ?>
                <strong style="margin: 0 5px;"><?= $i ?></strong>
            <?php else: ?>
                <a href="<?= $linkPage?>" style="margin: 0 5px;"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if ($currentPage < $totalPages): ?>
                <?php 
                $params = $_GET;
                $params['page'] = $currentPage + 1;
                $linkNext = "?" . http_build_query($params); ?>
            <a href="<?= $linkNext ?>">Вперёд →</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../../views/layouts/footer.php'; ?>