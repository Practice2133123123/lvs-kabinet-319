<?php include __DIR__ . '/layouts/header.php'; ?>

    <h1>Дашборд</h1>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div class="container" style="text-align: center; padding: 30px;">
            <div style="font-size: 32px; font-weight: bold; color: var(--secondary);">
                <?= htmlspecialchars($totalPoints) ?>
            </div>
            <div style="color: var(--text-light); margin-top: 10px; font-size: 14px;">
                Всего точек
            </div>
        </div>

        <div class="container" style="text-align: center; padding: 30px;">
            <div style="font-size: 32px; font-weight: bold; color: var(--warning);">
                <?= htmlspecialchars($openDefects) ?>
            </div>
            <div style="color: var(--text-light); margin-top: 10px; font-size: 14px;">
                Открытых дефектов
            </div>
        </div>

        <div class="container" style="text-align: center; padding: 30px;">
            <div style="font-size: 32px; font-weight: bold; color: var(--success);">
                <?= htmlspecialchars($totalCable) ?>
            </div>
            <div style="color: var(--text-light); margin-top: 10px; font-size: 14px;">
                Кабель (м)
            </div>
        </div>
    </div>

<?php include __DIR__ . '/layouts/footer.php'; ?>