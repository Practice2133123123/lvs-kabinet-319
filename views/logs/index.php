<?php include __DIR__ . '/../../views/layouts/header.php'; ?>

    <h1>Журнал действий</h1>

    <div class="filter-dropdown">
        <button class="btn btn-secondary" onclick="toggleFilter('logFilter')">Фильтры</button>
        <div id="logFilter" class="filter-menu hidden">
            <form method="GET">
                <div class="filter-group">
                    <label>Пользователь:</label>
                    <select name="user_id">
                        <option value="">Все</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?= $user['id'] ?>" <?= ($user_id ?? '') == $user['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($user['login']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Действие:</label>
                    <select name="action">
                        <option value="">Все</option>
                        <option value="CREATE" <?= ($action ?? '') == 'CREATE' ? 'selected' : '' ?>>CREATE</option>
                        <option value="UPDATE" <?= ($action ?? '') == 'UPDATE' ? 'selected' : '' ?>>UPDATE</option>
                        <option value="DELETE" <?= ($action ?? '') == 'DELETE' ? 'selected' : '' ?>>DELETE</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Дата с:</label>
                    <input type="date" name="date_from" value="<?= htmlspecialchars($date_from ?? '') ?>">
                </div>
                <div class="filter-group">
                    <label>Дата по:</label>
                    <input type="date" name="date_to" value="<?= htmlspecialchars($date_to ?? '') ?>">
                </div>
                <div class="filter-group">
                    <button type="submit" class="btn btn-primary">Применить</button>
                    <a href="logs.php" class="btn btn-secondary" style="margin-left: 8px;">Сбросить</a>
                </div>
            </form>
        </div>
    </div>

<?php if (empty($logs)): ?>
    <div class="empty-state">Нет записей.</div>
<?php else: ?>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Пользователь</th>
            <th>Действие</th>
            <th>Таблица</th>
            <th>ID записи</th>
            <th>Дата и время</th>
        </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table>
<?php endif; ?>

<?php if ($totalPages > 1): ?>
    <div class="pagination-links">
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
                <strong><?= $i ?></strong>
            <?php else: ?>
                <a href="<?= $linkPage?>"><?= $i ?></a>
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
