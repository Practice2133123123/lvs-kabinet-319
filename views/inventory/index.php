<?php include '../views/layouts/header.php'; ?>

    <h2>Сетевые точки</h2>
    <table class="table">
    <thead>
    <tr><th>Метка</th><th>Тип</th><th>Расположение</th><th>Статус</th></tr>
    </thead>
    <tbody>
    <?php foreach ($points as $point): ?>
        <tr>
            <td><?= htmlspecialchars($point['label']) ?></td>
            <td><?= htmlspecialchars($point['type']) ?></td>
            <td><?= htmlspecialchars($point['location']) ?></td>
            <td><?= htmlspecialchars($point['status']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    </tr>

<?php include '../views/layouts/footer.php'; ?>