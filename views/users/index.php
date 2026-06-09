<?php include __DIR__ . '/../../views/layouts/header.php'; ?>

    <div class="container mt-4">
        <h1>Управление пользователями</h1>

        <?php if ($error): ?>
            <div style="color: red; background: #f8d7da; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div style="color: green; background: #d4edda; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <p><a href="register.php">+ Добавить пользователя</a></p>

        <table border="1" cellpadding="10" width="100%" style="border-collapse: collapse;">
            <tr style="background: #f0f0f0;">
                <th>ID</th>
                <th>Логин</th>
                <th>Роль</th>
                <th>Дата регистрации</th>
                <th>Действия</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['login']) ?></td>
                    <td>
                        <form method="POST" style="margin:0;">
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
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                <input type="hidden" name="delete_user" value="1">
                                <button type="submit">Удалить</button>
                            </form>
                        <?php else: ?>
                            <span style="background: green; color: white; padding: 2px 8px; border-radius: 4px;">Текущий</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Пагинация -->
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
    </div>

<?php include __DIR__ . '/../../views/layouts/footer.php'; ?>