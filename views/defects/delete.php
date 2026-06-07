<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4" style="max-width: 600px;">
    <h2>Удаление дефекта</h2>
    
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <a href="../defects/defects.php" class="btn btn-secondary">Назад к списку</a>
    <?php else: ?>
        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> <?= htmlspecialchars($defect['id']) ?></p>
                <p><strong>Точка:</strong> <?= htmlspecialchars($defect['point_label'] ?? '—') ?></p>
                <p><strong>Категория:</strong> <?= htmlspecialchars($defect['category'] ?? '—') ?></p>
                <p><strong>Описание:</strong> <?= htmlspecialchars($defect['description'] ?? '—') ?></p>
                <p><strong>Статус:</strong> <?= htmlspecialchars($defect['status']) ?></p>
            </div>
        </div>
        
        <form method="POST" class="mt-3">
            <button type="submit" class="btn btn-danger">удалить</button>
            <a href="../defects/defects.php" class="btn btn-secondary">Отмена</a>
        </form>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>