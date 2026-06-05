<?php include __DIR__ . '/../layouts/header_auth.php'; ?>

<h2>Регистрация</h2>

<?php if ($error): ?>
    <div style="color: red; background: #f8d7da; padding: 10px; margin-bottom: 20px;">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<?php if ($success): ?>
    <div style="color: green; background: #d7f8da; padding: 10px; margin-bottom: 20px;">
        <?= htmlspecialchars($success) ?>
    </div>
    <p><a href="login.php">Перейти к входу</a></p>
<?php else: ?>
    <form method="POST" action="">
        <div>
            <label>Логин *</label><br>
            <input type="text" name="login" required>
        </div>
        <div>
            <label>Пароль *</label><br>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>Повторите пароль *</label><br>
            <input type="password" name="confirm_password" required>
        </div>
        <button type="submit">Зарегистрироваться</button>
    </form>
    <p>Уже есть аккаунт? <a href="login.php">Войти</a></p>
<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
