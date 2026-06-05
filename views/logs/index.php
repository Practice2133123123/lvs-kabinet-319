<?php include '../views/layouts/header.php'; ?>

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
                                <?= htmlspecialchars($user['login']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
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
                <?php if (empty($logs)): ?>
                    <tr>
                        <td colspan="6" class="text-center">Нет записей в журнале</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><?= htmlspecialchars($log['id']) ?></td>
                            <td><?= htmlspecialchars($log['user_login'] ?? '—') ?></td>
                            <td>
                                <span class="badge bg-<?= 
                                    $log['action'] == 'CREATE' ? 'success' : 
                                    ($log['action'] == 'UPDATE' ? 'warning' : 
                                    ($log['action'] == 'DELETE' ? 'danger' : 'secondary')) 
                                ?>">
                                    <?= htmlspecialchars($log['action']) ?>
                                </span>
                            </td>
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

<?php include '../views/layouts/footer.php'; ?>