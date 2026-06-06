<?php include '../views/layouts/header.php'; ?>

<div class="container mt-4" style="max-width: 600px;">
    <h2>Удаление расхода материала</h2>
    
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <a href="materials.php" class="btn btn-secondary">Назад к списку</a>
    <?php else: ?>
        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> <?= htmlspecialchars($item['id'] ?? '') ?></p>
                <p><strong>Материал:</strong> <?= htmlspecialchars($item['material_name'] ?? '') ?></p>
                <p><strong>Количество:</strong> <?= htmlspecialchars($item['quantity'] ?? '') ?> <?= htmlspecialchars($item['unit'] ?? '') ?></p>
                <p><strong>Дата:</strong> <?= htmlspecialchars($item['used_at'] ?? '') ?></p>
                <p><strong>Комментарий:</strong> <?= htmlspecialchars($item['comment'] ?? '—') ?></p>
            </div>
        </div>
        
        <form method="POST" class="mt-3">
            <button type="submit" class="btn btn-danger">удалить</button>
            <a href="materials.php" class="btn btn-secondary">Отмена</a>
        </form>
    <?php endif; ?>
</div>

<?php include '../views/layouts/footer.php'; ?>