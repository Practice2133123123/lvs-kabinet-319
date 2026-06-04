<?php include __DIR__ . '/layouts/header.php'; ?>

    <h1>Дашборд</h1>

    <table border="1" cellpadding="10">
        <tr>
            <th>Всего точек</th>
            <th>Открытых дефектов</th>
            <th>Кабель (м)</th>
        </tr>
        <tr>
            <td align="center"><?= htmlspecialchars($totalPoints) ?></td>
            <td align="center"><?= htmlspecialchars($openDefects) ?></td>
            <td align="center"><?= htmlspecialchars($totalCable) ?></td>
        </tr>
    </table>

<?php include __DIR__ . '/layouts/footer.php'; ?>