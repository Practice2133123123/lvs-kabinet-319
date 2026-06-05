<?php include __DIR__ . '/layouts/header.php'; ?>

    <h2>Дашборд</h2>

    <hr>

    <table border="1" cellpadding="15" cellspacing="0" width="100%">
        <tr bgcolor="#f0f0f0">
            <th width="33%">Всего сетевых точек</th>
            <th width="33%">Открытых дефектов</th>
            <th width="33%">Израсходовано кабеля</th>
        </tr>
        <tr align="center">
            <td><strong><?= number_format($totalPoints) ?> шт</strong></td>
            <td><strong><?= number_format($openDefects) ?> шт</strong></td>
            <td><strong><?= number_format($totalCable, 2) ?> м</strong></td>
        </tr>
    </table>

<?php include __DIR__ . '/layouts/footer.php'; ?>