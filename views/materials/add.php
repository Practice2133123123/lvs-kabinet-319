<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4" style="max-width: 600px;">
    <h2>Добавить расход материала</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <a href="materials.php" class="btn btn-primary">Вернуться к списку</a>
    <?php else: ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">Материал *</label>
                <select name="material_id" class="form-control" required>
                    <option value="">Выберите материал</option>
                    <?php foreach ($materials as $m): ?>
                        <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Количество *</label>
                <input type="number" step="0.01" name="quantity" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Привязка к точке</label>
                <select name="point_id" class="form-control">
                    <option value="">— Не выбрано —</option>
                    <?php foreach ($points as $p): ?>
                        <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['label']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Привязка к дефекту</label>
                <select name="defect_id" class="form-control">
                    <option value="">— Не выбрано —</option>
                    <?php foreach ($defects as $d): ?>
                        <option value="<?= $d['id'] ?>">#<?= $d['id'] ?> - <?= htmlspecialchars(substr($d['description'], 0, 50)) ?>...</option>
                    <?php endforeach; ?>
                </select>
            </div>

<<<<<<< HEAD
            <div class="mb-3">
                <label class="form-label">Комментарий</label>
                <textarea name="comment" class="form-control" rows="3"></textarea>
            </div>
=======
        <div class="form-group">
            <label>Привязка к дефекту</label>
            <select name="defect_id">
                <option value="">— Не выбрано —</option>
                <?php foreach ($defects as $d): ?>
                    <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['description']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Комментарий</label>
            <textarea name="comment" rows="3"></textarea>
        </div>
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0

            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="materials.php" class="btn btn-secondary">Отмена</a>
        </form>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
