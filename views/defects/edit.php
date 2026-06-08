<?php include __DIR__ . '/../../views/layouts/header.php'; ?>

<div class="container mt-4" style="max-width: 600px;">
    <h2>Редактирование дефекта #<?= htmlspecialchars($defect['id']) ?></h2>
    
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Сетевая точка </label>
            <select name="point_id" class="form-control" required>
                <option value="">Выберите точку</option>
                <?php foreach ($points as $point): ?>
                    <option value="<?= $point['id'] ?>" <?= ($point['id'] == $defect['point_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($point['label']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Категория </label>
            <input type="text" name="category" class="form-control" required 
                   value="<?= htmlspecialchars($defect['category'] ?? '') ?>">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Критичность </label>
            <select name="severity" class="form-control">
                <option value="high" <?= ($defect['severity'] == 'high') ? 'selected' : '' ?>>Высокая</option>
                <option value="medium" <?= ($defect['severity'] == 'medium') ? 'selected' : '' ?>>Средняя</option>
                <option value="low" <?= ($defect['severity'] == 'low') ? 'selected' : '' ?>>Низкая</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Описание </label>
            <textarea name="description" class="form-control" rows="4" required><?= htmlspecialchars($defect['description'] ?? '') ?></textarea>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Статус </label>
            <select name="status" class="form-control">
                <option value="open" <?= ($defect['status'] == 'open') ? 'selected' : '' ?>>Открыт</option>
                <option value="in_progress" <?= ($defect['status'] == 'in_progress') ? 'selected' : '' ?>>В работе</option>
                <option value="closed" <?= ($defect['status'] == 'closed') ? 'selected' : '' ?>>Закрыт</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="defects.php" class="btn btn-secondary">Отмена</a>
    </form>
</div>

<?php include __DIR__ . '/../../views/layouts/footer.php'; ?>
