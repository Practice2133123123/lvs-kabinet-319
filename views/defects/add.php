<?php include __DIR__ . '/../../views/layouts/header.php'; ?>

<div class="container mt-4" style="max-width: 600px;">
    <h2>Добавление дефекта</h2>
    
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <a href="../defects/defects.php" class="btn btn-primary">Вернуться к списку</a>
    <?php else: ?>
        <form method="POST">
            <?= csrfField() ?>
            <div class="mb-3">
                <label class="form-label">Сетевая точка *</label>
                <select name="point_id" class="form-control" required>
                    <option value="">Выберите точку</option>
                    <?php foreach ($points as $point): ?>
                        <option value="<?= $point['id'] ?>"><?= htmlspecialchars($point['label']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Категория *</label>
                <input type="text" name="category" class="form-control" required 
                       value="<?= htmlspecialchars($_POST['category'] ?? '') ?>">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Критичность *</label>
                <select name="severity" class="form-control">
                    <option value="high">High - Высокая</option>
                    <option value="medium" selected>Medium - Средняя</option>
                    <option value="low">Low - Низкая</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Описание *</label>
                <textarea name="description" class="form-control" rows="4" required><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Статус *</label>
                <select name="status" class="form-control">
                    <option value="open">Open - Открыт</option>
                    <option value="in_progress">In Progress - В работе</option>
                    <option value="closed">Closed - Закрыт</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="../defects/defects.php" class="btn btn-secondary">Отмена</a>
        </form>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../../views/layouts/footer.php'; ?>
