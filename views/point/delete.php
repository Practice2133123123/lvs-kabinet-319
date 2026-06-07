<?php include __DIR__ . '/../layouts/header.php'; ?>

<<<<<<< HEAD
    
    <?php if ($error): ?>
            <?= htmlspecialchars($error) ?>
    <?php endif; ?>
    <div>
        <p><strong>ID:</strong> <?= htmlspecialchars($point['id']) ?></p>
        <p><strong>Метка:</strong> <?= htmlspecialchars($point['label']) ?></p>
        <p><strong>Тип:</strong> <?= htmlspecialchars($point['type']) ?></p>
        <p><strong>Расположение:</strong> <?= htmlspecialchars($point['location'] ?? '—') ?></p>
        <p><strong>Статус:</strong> <?= htmlspecialchars($point['status']) ?></p>
    </div>
    <?php 
    $hasDefects = hasDefects($pdo, $point['id']);
    ?>
    
    <?php if (!$hasDefects): ?>
        <form method="POST" onsubmit="return confirm('Точно удалить точку «<?= htmlspecialchars($point['label']) ?>»?');">
            <button type="submit">Удалить точку</button>
            <a href="inventory.php">Отмена</a>
        </form>
    <?php else: ?>
             <strong>Нельзя удалить эту точку!</strong><br>
            У неё есть связанные дефекты.
        <a href="inventory.php">Назад к списку</a>
    <?php endif; ?>
</div>
=======
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
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0

<?php include __DIR__ . '/../layouts/footer.php'; ?>