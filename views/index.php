<?php include __DIR__ . '/layouts/header.php'; ?>

<div class="dashboard">
    <div class="card">
        <h3>Всего точек</h3>
        <p class="number"><?= htmlspecialchars($totalPoints) ?></p>
    </div>
    <div class="card">
        <h3>Открытых дефектов</h3>
        <p class="number"><?= htmlspecialchars($openDefects) ?></p>
    </div>
    <div class="card">
        <h3>Кабель (м)</h3>
        <p class="number"><?= htmlspecialchars($totalCable) ?></p>
    </div>
</div>

<?php include __DIR__ . '/layouts/footer.php'; ?>