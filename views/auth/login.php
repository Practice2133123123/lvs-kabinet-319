<?php include __DIR__ . '/../layouts/header_auth.php'; ?>

    <div style="max-width: 400px; margin: 0 auto; padding: 30px; background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <h1 style="text-align: center; margin-bottom: 30px;">Авторизация</h1>

        <?php if (!empty($error)): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px; text-align: center;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Логин</label>
                <input type="text" name="login" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
            </div>
            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 5px;">Пароль</label>
                <input type="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
            </div>
            <button type="submit" style="width: 100%; padding: 12px; background: #2c3e66; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">Войти</button>
        </form>

        <p style="text-align: center; margin-top: 20px;">
            Нет аккаунта? <a href="/public/auth/register.php">Зарегистрироваться</a>
        </p>
    </div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>