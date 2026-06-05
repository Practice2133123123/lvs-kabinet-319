<?php include '../views/layouts/header.php'; ?>

    <h2>Журнал дефектов</h2>

    <hr>

    <h2>Фильтры</h2>

    <form method="GET">
        <table border="0">
            <tr>
                <td><label>Критичность:</label></td>
                <td>
                    <select name="severity">
                        <option value="">Все</option>
                        <option value="high" <?= isset($_GET['severity']) && $_GET['severity'] == 'high' ? 'selected' : '' ?>>High (высокая)</option>
                        <option value="medium" <?= isset($_GET['severity']) && $_GET['severity'] == 'medium' ? 'selected' : '' ?>>Medium (средняя)</option>
                        <option value="low" <?= isset($_GET['severity']) && $_GET['severity'] == 'low' ? 'selected' : '' ?>>Low (низкая)</option>
                    </select>
                </td>
                <td width="20"></td>
                <td><label>Статус:</label></td>
                <td>
                    <select name="status">
                        <option value="">Все</option>
                        <option value="open" <?= isset($_GET['status']) && $_GET['status'] == 'open' ? 'selected' : '' ?>>Open (открыт)</option>
                        <option value="in_progress" <?= isset($_GET['status']) && $_GET['status'] == 'in_progress' ? 'selected' : '' ?>>In Progress (в работе)</option>
                        <option value="closed" <?= isset($_GET['status']) && $_GET['status'] == 'closed' ? 'selected' : '' ?>>Closed (закрыт)</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <br>
                    <button type="submit">Применить фильтры</button>
                    &nbsp;&nbsp;
                    <a href="defects.php">Сбросить все фильтры</a>
                </td>
            </tr>
        </table>
    </form>

    <hr>

<?php if (empty($defects)): ?>
    <p><strong>Нет данных по выбранным фильтрам</strong></p>
<?php else: ?>
    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Точка</th>
            <th>Категория</th>
            <th>Критичность</th>
            <th>Статус</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($defects as $defect): ?>
            <tr>
                <td><?= htmlspecialchars($defect['id']) ?></td>
                <td><?= htmlspecialchars($defect['network_label'] ?? '—') ?></td>
                <td><?= htmlspecialchars($defect['category'] ?? '—') ?></td>
                <td><?= htmlspecialchars($defect['severity'] ?? '—') ?></td>
                <td><?= htmlspecialchars($defect['status'] ?? '—') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php include '../views/layouts/footer.php'; ?>