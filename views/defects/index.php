<?php include __DIR__ . '/../../views/layouts/header.php'; ?>

    <h1>Дефекты</h1>

    <p><a href="defect_add.php">+ Добавить дефект</a></p>

<?php include __DIR__ . '/summary.php'; ?>

    <div style="margin-bottom: 20px;">
        <button onclick="toggleFilters()" style="padding: 8px 16px; cursor: pointer;">Фильтры</button>
    </div>

    <div id="filterPanel" style="display: none; margin-bottom: 20px; padding: 20px; border: 1px solid #ddd; background: #f9f9f9; border-radius: 8px;">
        <form method="GET">
            <div style="margin-bottom: 15px;">
                <label style="display: inline-block; width: 100px;">Критичность:</label>
                <select name="severity" style="padding: 6px 12px; width: 200px;">
                    <option value="">Все</option>
                    <option value="высокая" <?= isset($_GET['severity']) && $_GET['severity'] == 'высокая' ? 'selected' : '' ?>>Высокая</option>
                    <option value="средняя" <?= isset($_GET['severity']) && $_GET['severity'] == 'средняя' ? 'selected' : '' ?>>Средняя</option>
                    <option value="низкая" <?= isset($_GET['severity']) && $_GET['severity'] == 'низкая' ? 'selected' : '' ?>>Низкая</option>
                </select>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: inline-block; width: 100px;">Статус:</label>
                <select name="status" style="padding: 6px 12px; width: 200px;">
                    <option value="">Все</option>
                    <option value="открыт" <?= isset($_GET['status']) && $_GET['status'] == 'открыт' ? 'selected' : '' ?>>Открыт</option>
                    <option value="в_работе" <?= isset($_GET['status']) && $_GET['status'] == 'в_работе' ? 'selected' : '' ?>>В работе</option>
                    <option value="закрыт" <?= isset($_GET['status']) && $_GET['status'] == 'закрыт' ? 'selected' : '' ?>>Закрыт</option>
                </select>
            </div>
            <div>
                <button type="submit" style="padding: 6px 16px; cursor: pointer;">Применить</button>
                <a href="defects.php" style="margin-left: 10px;">Сбросить</a>
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

<?php if (empty($defects)): ?>
    <p>Нет дефектов.</p>
<?php else: ?>
    <table border="1" cellpadding="10" width="100%" style="border-collapse: collapse;">
        <tr style="background: #f0f0f0;">
            <th>ID</th>
            <th>Точка</th>
            <th>Категория</th>
            <th>Критичность</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($defects as $defect): ?>
            <tr>
                <td><?= htmlspecialchars($defect['id']) ?></td>
                <td><?= htmlspecialchars($defect['point_label'] ?? '—') ?></td>
                <td><?= htmlspecialchars($defect['category'] ?? '—') ?></td>
                <td><?= htmlspecialchars($defect['severity'] ?? '—') ?></td>
                <td><?= htmlspecialchars($defect['status'] ?? '—') ?></td>
                <td>
                    <a href="defect_edit.php?id=<?= $defect['id'] ?>">Ред.</a> |
                    <a href="defect_delete.php?id=<?= $defect['id'] ?>" onclick="return confirm('Удалить дефект?')">Удал.</a>
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