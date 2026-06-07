<?php include '../../views/layouts/header.php'; ?>

    <div class="container mt-4">
        <h1>Журнал действий пользователей</h1>

        <!-- Фильтры -->
        <form method="GET" style="margin-bottom: 20px; padding: 15px; border: 1px solid #ccc; border-radius: 5px;">
            <div style="display: flex; flex-wrap: wrap; gap: 15px; align-items: flex-end;">
                <div>
                    <label>Пользователь:</label><br>
                    <select name="user_id">
                        <option value="">Все</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?= $user['id'] ?>" <?= ($user_id == $user['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($user['login']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label>Действие:</label><br>
                    <select name="action">
                        <option value="">Все</option>
                        <option value="CREATE" <?= $action == 'CREATE' ? 'selected' : '' ?>>CREATE</option>
                        <option value="UPDATE" <?= $action == 'UPDATE' ? 'selected' : '' ?>>UPDATE</option>
                        <option value="DELETE" <?= $action == 'DELETE' ? 'selected' : '' ?>>DELETE</option>
                        <option value="UPDATE_ROLE" <?= $action == 'UPDATE_ROLE' ? 'selected' : '' ?>>UPDATE_ROLE</option>
                    </select>
                </div>

                <div>
                    <label>Дата с:</label><br>
                    <input type="date" name="date_from" value="<?= htmlspecialchars($date_from) ?>">
                </div>

                <div>
                    <label>Дата по:</label><br>
                    <input type="date" name="date_to" value="<?= htmlspecialchars($date_to) ?>">
                </div>

                <div>
                    <button type="submit">Применить</button>
                    <a href="logs.php">Сбросить</a>
                </div>
            </div>
        </form>

        <!-- Таблица логов -->
        <div class="table-responsive">
            <table border="1" cellpadding="8" style="width:100%; border-collapse: collapse;">
                <thead style="background: #f0f0f0;">
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
                <?php if (empty($points)): ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Нет записей в журнале</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($points as $log): ?>
                        <tr>
                            <td><?= htmlspecialchars($log['id']) ?></td>
                            <td><?= htmlspecialchars($log['user_login'] ?? '—') ?></td>
                            <td><?= htmlspecialchars($log['action']) ?></td>
                            <td><?= htmlspecialchars($log['target_table']) ?></td>
                            <td><?= htmlspecialchars($log['target_id'] ?? '—') ?></td>
                            <td><?= htmlspecialchars($log['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
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

<?php include '../../views/layouts/footer.php'; ?>