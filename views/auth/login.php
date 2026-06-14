    <div class="card" style="max-width: 400px; margin: 0 auto;">
        <h1 style="text-align: center; margin-bottom: 30px; border: none;">Авторизация</h1>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <?= csrfField() ?>
            <div class="form-group">
                <label>Логин</label>
                <input type="text" name="login" required>
            </div>
            <div class="form-group">
                <label>Пароль</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Войти</button>
        </form>

        <p class="text-center" style="margin-top: 20px;">
            Нет аккаунта? <a href="/public/auth/register.php">Зарегистрироваться</a>
        </p>
    </div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
