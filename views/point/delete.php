<?php include __DIR__ . '/../layouts/header.php'; ?>

    <div class="container">
        <h1>Удаление сетевой точки</h1>

        <?php if ($error): ?>
            <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 20px;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> <?= htmlspecialchars($point['id']) ?></p>
                <p><strong>Метка:</strong> <?= htmlspecialchars($point['label']) ?></p>
                <p><strong>Тип:</strong> <?= htmlspecialchars($point['type']) ?></p>
                <p><strong>Расположение:</strong> <?= htmlspecialchars($point['location'] ?? '—') ?></p>
                <p><strong>Статус:</strong> <?= htmlspecialchars($point['status']) ?></p>
            </div>
        </div>
            <!-- <div>
                <td><th>ID</th> <?= htmlspecialchars() ?></td>
                <td><th>Метка</th> <?= htmlspecialchars() ?></td>
                <td><th>Тип</th> <?= htmlspecialchars() ?></td>
                <td><th>Расположение</th><?= htmlspecialchars() ?></td>
                <td><th>Статус</th><?= htmlspecialchars() ?></td>
        </div> -->

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