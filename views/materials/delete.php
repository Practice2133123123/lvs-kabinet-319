<?php include __DIR__ . '/../../views/layouts/header.php'; ?>

<div class="container mt-4" style="max-width: 600px;">
    <h2>Удаление расхода материалов</h2>
    
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <a href="../materials/materials.php" class="btn btn-secondary">Назад к списку</a>
    <?php else: ?>
        <div class="card">
            <div class="card-body">
                <p><strong>Материал:</strong> <?= htmlspecialchars($item['material_name'] ?? '—') ?></p>
                <p><strong>Количество:</strong> <?= htmlspecialchars($item['quantity']) ?> <?= htmlspecialchars($item['unit'] ?? '') ?></p>
                <p><strong>Точка:</strong> <?= htmlspecialchars($item['point_label'] ?? '—') ?></p>
                <p><strong>Кто использовал:</strong> <?= htmlspecialchars($item['user_name'] ?? '—') ?></p>
                <p><strong>Дата:</strong> <?= htmlspecialchars($item['used_at']) ?></p>
                <p><strong>Комментарий:</strong> <?= htmlspecialchars($item['comment'] ?? '—') ?></p>
            </div>
        </div>
        
        <form method="POST" class="mt-3">
            <?= csrfField() ?>
            <button type="submit" class="btn btn-danger">удалить</button>
            <a href="../materials/materials.php" class="btn btn-secondary">Отмена</a>
        </form>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../../views/layouts/footer.php'; ?>