<?php include __DIR__ . '/../../views/layouts/header.php'; ?>

    <h2>Добавить расход материала</h2>

<?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<?php if ($success): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>Материал *</label>
            <select name="material_id" required>
                <option value="">Выберите материал</option>
                <?php foreach ($materials as $m): ?>
                    <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Количество *</label>
            <input type="number" step="0.01" name="quantity" required>
        </div>

        <div class="form-group">
            <label>Привязка к точке</label>
            <select name="point_id">
                <option value="">— Не выбрано —</option>
                <?php foreach ($points as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['label']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

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

        <button type="submit">Сохранить</button>
        <a href="materials.php">Отмена</a>
    </form>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
