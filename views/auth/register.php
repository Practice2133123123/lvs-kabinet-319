<?php include '../views/layouts/header.php'; ?>

    <div class="wrapper">
        <h2>Регистрация</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <p><a href="login.php">Перейти к входу</a></p>
        <?php else: ?>
            <form method="POST" action="">
                <div class="input-box">
                    <label>Логин</label>
                    <input type="text" name="login" required>
                </div>
                <div class="input-box">
                    <label>Пароль</label>
                    <input type="password" name="password" required>
                </div>
                <div class="input-box">
                    <label>Повторите пароль</label>
                    <input type="password" name="confirm_password" required>
                </div>
                <button type="submit">Зарегистрироваться</button>
            </form>
            <p>Уже есть аккаунт? <a href="login.php">Войти</a></p>
        <?php endif; ?>
    </div>

<?php include '../views/layouts/footer.php'; ?>