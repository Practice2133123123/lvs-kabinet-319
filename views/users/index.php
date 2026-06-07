<?php include '../views/layouts/header.php'; ?>

<<<<<<< HEAD
<div class="container mt-4">
    <h1>Управление пользователями</h1>
    
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
=======
    <div class="container mt-4">
        <h1>Управление пользователями</h1>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table border="1" cellpadding="8" style="width:100%; border-collapse: collapse;">
                <thead style="background: #f0f0f0;">
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0
                <tr>
                    <th>ID</th>
                    <th>Логин</th>
                    <th>Роль</th>
                    <th>Дата регистрации</th>
                    <th>Действия</th>
                </tr>
<<<<<<< HEAD
            </thead>
            <tbody>
=======
                </thead>
                <tbody>
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['login']) ?></td>
                        <td>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
<<<<<<< HEAD
                                <select name="role" onchange="this.form.submit()" class="form-select form-select-sm" style="width: auto; display: inline-block;">
=======
                                <select name="role" onchange="this.form.submit()">
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0
                                    <option value="operator" <?= $user['role'] === 'operator' ? 'selected' : '' ?>>Оператор</option>
                                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Администратор</option>
                                </select>
                                <input type="hidden" name="update_role" value="1">
                            </form>
                        </td>
                        <td><?= htmlspecialchars($user['created_at'] ?? '—') ?></td>
                        <td>
                            <?php if ($user['id'] != $_SESSION['user_id']): ?>
<<<<<<< HEAD
                                <form method="POST" style="display: inline;" onsubmit="return confirm('Удалить пользователя «<?= htmlspecialchars($user['login']) ?>»?')">
                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                    <input type="hidden" name="delete_user" value="1">
                                    <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                                </form>
                            <?php else: ?>
                                <span class="text-muted">Текущий пользователь</span>
=======
                                <form method="POST" style="display: inline;" onsubmit="return confirm('Удалить пользователя?')">
                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                    <input type="hidden" name="delete_user" value="1">
                                    <button type="submit">Удалить</button>
                                </form>
                            <?php else: ?>
                                <span>Текущий пользователь</span>
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
<<<<<<< HEAD
            </tbody>
        </table>
    </div>
    
    <div class="mt-3">
        <a href="register.php" class="btn btn-primary"> Добавить пользователя</a>
    </div>
</div>
=======
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            <a href="register.php">+ Добавить пользователя</a>
        </div>
    </div>
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0

<?php include '../views/layouts/footer.php'; ?>