<?php include __DIR__ . '/../layouts/header.php'; ?>

    
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

<?php include __DIR__ . '/../layouts/footer.php'; ?>