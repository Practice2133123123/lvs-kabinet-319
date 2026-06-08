<?php include __DIR__ . '/../layouts/header.php'; ?>

    <div class="container">
        <h1>Удаление сетевой точки</h1>

        <?php if ($error): ?>
            <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 20px;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <table border="1" cellpadding="8" style="border-collapse: collapse; margin-bottom: 20px;">
            <tr>
                <th style="text-align: left;">ID</th>
                <td><?= htmlspecialchars($point['id']) ?></td>
            </tr>
            <tr>
                <th style="text-align: left;">Метка</th>
                <td><?= htmlspecialchars($point['label']) ?></td>
            </tr>
            <tr>
                <th style="text-align: left;">Тип</th>
                <td><?= htmlspecialchars($point['type']) ?></td>
            </tr>
            <tr>
                <th style="text-align: left;">Расположение</th>
                <td><?= htmlspecialchars($point['location'] ?? '—') ?></td>
            </tr>
            <tr>
                <th style="text-align: left;">Статус</th>
                <td><?= htmlspecialchars($point['status']) ?></td>
            </tr>
        </table>

        <?php if ($error): ?>
            <a href="inventory.php">Назад к списку</a>
        <?php else: ?>
            <form method="POST" onsubmit="return confirm('Точно удалить точку «<?= htmlspecialchars($point['label']) ?>»?');" style="display: inline;">
                <button type="submit">Удалить точку</button>
            </form>
            <a href="inventory.php" style="margin-left: 10px;">Отмена</a>
        <?php endif; ?>
    </div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>