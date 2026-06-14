    <div class="card" style="max-width: 400px; margin: 0 auto;">
        <h2 style="text-align: center; margin-bottom: 30px; border: none;">Регистрация</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <p class="text-center"><a href="/public/auth/login.php">Перейти к входу</a></p>
        <?php else: ?>
            <form method="POST">
                <?= csrfField() ?>
                <div class="form-group">
                    <label>Логин *</label>
                    <input type="text" name="login" required>
                </div>
                <div class="form-group">
                    <label>Пароль *</label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label>Повторите пароль *</label>
                    <input type="password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Зарегистрироваться</button>
            </form>
            <p class="text-center" style="margin-top: 20px;">
                Уже есть аккаунт? <a href="/public/auth/login.php">Войти</a>
            </p>
        <?php endif; ?>
    </div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
