<?php include __DIR__ . '/../../views/layouts/header.php'; ?>

    <div class="container mt-4">
        <h1>Управление пользователями</h1>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <p><a href="register.php" class="btn btn-primary">+ Добавить пользователя</a></p>

        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Логин</th>
                <th>Роль</th>
                <th>Дата регистрации</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['login']) ?></td>
                    <td>
                        <form method="POST" style="margin:0;">
                            <?= csrfField() ?>
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <select name="role" onchange="this.form.submit()">
                                <option value="operator" <?= $user['role'] === 'operator' ? 'selected' : '' ?>>Оператор</option>
                                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Администратор</option>
                            </select>
                            <input type="hidden" name="update_role" value="1">
                        </form>
                    </td>
                    <td><?= htmlspecialchars($user['created_at'] ?? '—') ?></td>
                    <td>
                        <?php if ($user['id'] != $_SESSION['user_id']): ?>
                            <form method="POST" style="margin:0;" onsubmit="return confirm('Удалить пользователя?')">
                                <?= csrfField() ?>
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                <input type="hidden" name="delete_user" value="1">
                                <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                            </form>
                        <?php else: ?>
                            <span class="badge badge-success">Текущий</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <?php if ($totalPages > 1): ?>
            <div class="pagination-links">
                <?php if ($currentPage > 1): ?>
                    <a href="?page=<?= $currentPage - 1 ?>">← Назад</a>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <?php if ($i == $currentPage): ?>
                        <strong><?= $i ?></strong>
                    <?php else: ?>
                        <a href="?page=<?= $i ?>"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
                <?php if ($currentPage < $totalPages): ?>
                    <a href="?page=<?= $currentPage + 1 ?>">Вперёд →</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

<?php include __DIR__ . '/../../views/layouts/footer.php'; ?>
