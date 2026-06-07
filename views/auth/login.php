<?php include __DIR__ . '/../layouts/header.php'; ?>

    <div class="wrapper">
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <h1>Авторизация</h1>
            <div class="input-box">
                <label>Логин</label>
                <input type="text" name="login" required>
            </div>
            <div class="input-box">
                <label>Пароль</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Войти</button>
        </form>
    </div>

    <p>Нет аккаунта? <a href="http://localhost/lvs/public/auth/register.php">Зарегистрироваться</a></p>

<?php include __DIR__ . '/../layouts/footer.php'; ?>