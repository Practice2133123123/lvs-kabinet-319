<?php include __DIR__ . '/../../views/layouts/header.php'; ?>

    <h1>Журнал действий</h1>

    <!-- Кнопка фильтров -->
    <button onclick="toggleFilters()" style="margin-bottom: 10px; padding: 5px 15px;">Фильтры</button>

    <!-- Скрытая панель фильтров -->
    <div id="filterPanel" style="display: none; margin-bottom: 20px; padding: 15px; border: 1px solid #ccc; background: #f9f9f9;">
        <form method="GET">
            <label>Пользователь:</label>
            <select name="user_id">
                <option value="">Все</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user['id'] ?>" <?= ($user_id ?? '') == $user['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($user['login']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Действие:</label>
            <select name="action">
                <option value="">Все</option>
                <option value="CREATE" <?= ($action ?? '') == 'CREATE' ? 'selected' : '' ?>>CREATE</option>
                <option value="UPDATE" <?= ($action ?? '') == 'UPDATE' ? 'selected' : '' ?>>UPDATE</option>
                <option value="DELETE" <?= ($action ?? '') == 'DELETE' ? 'selected' : '' ?>>DELETE</option>
            </select>

            <label>Дата с:</label>
            <input type="date" name="date_from" value="<?= htmlspecialchars($date_from ?? '') ?>">

            <label>Дата по:</label>
            <input type="date" name="date_to" value="<?= htmlspecialchars($date_to ?? '') ?>">

            <button type="submit">Применить</button>
            <a href="logs.php">Сбросить</a>
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

<?php if (empty($logs)): ?>
    <p>Нет записей.</p>
<?php else: ?>
    <table border="1" cellpadding="8" width="100%">
        <tr bgcolor="#f0f0f0">
            <th>ID</th>
            <th>Пользователь</th>
            <th>Действие</th>
            <th>Таблица</th>
            <th>ID записи</th>
            <th>Дата</th>
        </tr>
        <?php foreach ($logs as $log): ?>
            <tr>
                <td><?= htmlspecialchars($log['id']) ?></td>
                <td><?= htmlspecialchars($log['user_login'] ?? '—') ?></td>
                <td><?= htmlspecialchars($log['action']) ?></td>
                <td><?= htmlspecialchars($log['target_table']) ?></td>
                <td><?= htmlspecialchars($log['target_id'] ?? '—') ?></td>
                <td><?= htmlspecialchars($log['created_at']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

    <!-- Пагинация -->
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