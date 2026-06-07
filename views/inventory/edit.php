<<<<<<< HEAD
<?php include '../views/layouts/header.php'; ?>

=======
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0
<div class="container mt-4">
    <h1>Редактирование сетевой точки</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label">Метка *</label>
            <input type="text" name="label" class="form-control" value="<?= htmlspecialchars($point['label']) ?>" required>
<<<<<<< HEAD
            <small class="form-text text-muted">Метка должна быть уникальной. Изменяйте с осторожностью.</small>
        </div>
        
=======
        </div>

>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0
        <div class="mb-3">
            <label class="form-label">Тип *</label>
            <select name="type" class="form-select" required>
                <option value="socket" <?= $point['type'] == 'socket' ? 'selected' : '' ?>>Розетка</option>
                <option value="switch" <?= $point['type'] == 'switch' ? 'selected' : '' ?>>Коммутатор</option>
                <option value="cable_run" <?= $point['type'] == 'cable_run' ? 'selected' : '' ?>>Кабель</option>
                <option value="patch_cord" <?= $point['type'] == 'patch_cord' ? 'selected' : '' ?>>Патч-корд</option>
            </select>
        </div>
<<<<<<< HEAD
        
        <div class="mb-3">
            <label class="form-label">Расположение</label>
            <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($point['location'] ?? '') ?>" placeholder="кабинет, стойка...">
        </div>
        
=======

        <div class="mb-3">
            <label class="form-label">Расположение</label>
            <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($point['location'] ?? '') ?>">
        </div>

>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0
        <div class="mb-3">
            <label class="form-label">Статус *</label>
            <select name="status" class="form-select" required>
                <option value="active" <?= $point['status'] == 'active' ? 'selected' : '' ?>>Активна</option>
                <option value="defect" <?= $point['status'] == 'defect' ? 'selected' : '' ?>>Дефект</option>
                <option value="decommissioned" <?= $point['status'] == 'decommissioned' ? 'selected' : '' ?>>Списана</option>
            </select>
        </div>
<<<<<<< HEAD
        
=======

        <div class="mb-3">
            <label class="form-label">Дата последней проверки</label>
            <input type="date" name="last_check" class="form-control" value="<?= htmlspecialchars($point['last_check'] ?? '') ?>">
        </div>

>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="inventory.php" class="btn btn-secondary">Отмена</a>
        </div>
    </form>
<<<<<<< HEAD
</div>

<?php include '../views/layouts/footer.php'; ?>
=======
</div>
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0
