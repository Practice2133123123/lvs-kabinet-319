<?php include '../views/layouts/header.php'; ?>

<<<<<<< HEAD
<div class="container mt-4">
    <h1>Журнал действий пользователей</h1>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <form method="GET" class="row g-3">
                <div class="col-auto">
                    <label class="form-label">Фильтр по пользователю:</label>
                </div>
                <div class="col-auto">
                    <select name="user_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Все пользователи</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?= $user['id'] ?>" <?= ($user_filter == $user['id']) ? 'selected' : '' ?>>
=======
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
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0
                                <?= htmlspecialchars($user['login']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
<<<<<<< HEAD
                <div class="col-auto">
                    <label class="form-label">Лимит:</label>
                </div>
                <div class="col-auto">
                    <select name="limit" class="form-select" onchange="this.form.submit()">
                        <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50</option>
                        <option value="100" <?= $limit == 100 ? 'selected' : '' ?>>100</option>
                        <option value="200" <?= $limit == 200 ? 'selected' : '' ?>>200</option>
                        <option value="500" <?= $limit == 500 ? 'selected' : '' ?>>500</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
=======

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
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0
                <tr>
                    <th>ID</th>
                    <th>Пользователь</th>
                    <th>Действие</th>
                    <th>Таблица</th>
                    <th>ID записи</th>
                    <th>Дата и время</th>
                </tr>
<<<<<<< HEAD
            </thead>
            <tbody>
                <?php if (empty($logs)): ?>
                    <tr>
                        <td colspan="6" class="text-center">Нет записей в журнале</td>
=======
                </thead>
                <tbody>
                <?php if (empty($logs)): ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Нет записей в журнале</td>
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0
                    </tr>
                <?php else: ?>
                    <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><?= htmlspecialchars($log['id']) ?></td>
                            <td><?= htmlspecialchars($log['user_login'] ?? '—') ?></td>
<<<<<<< HEAD
                            <td>
                                <span class="badge bg-<?= 
                                    $log['action'] == 'CREATE' ? 'success' : 
                                    ($log['action'] == 'UPDATE' ? 'warning' : 
                                    ($log['action'] == 'DELETE' ? 'danger' : 'secondary')) 
                                ?>">
                                    <?= htmlspecialchars($log['action']) ?>
                                </span>
                            </td>
=======
                            <td><?= htmlspecialchars($log['action']) ?></td>
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0
                            <td><?= htmlspecialchars($log['target_table']) ?></td>
                            <td><?= htmlspecialchars($log['target_id'] ?? '—') ?></td>
                            <td><?= htmlspecialchars($log['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
<<<<<<< HEAD
            </tbody>
        </table>
    </div>
</div>
=======
                </tbody>
            </table>
        </div>
    </div>
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0

<?php include '../views/layouts/footer.php'; ?>