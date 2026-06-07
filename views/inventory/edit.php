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
        </div>

        <div class="mb-3">
            <label class="form-label">Тип *</label>
            <select name="type" class="form-select" required>
                <option value="socket" <?= $point['type'] == 'socket' ? 'selected' : '' ?>>Розетка</option>
                <option value="switch" <?= $point['type'] == 'switch' ? 'selected' : '' ?>>Коммутатор</option>
                <option value="cable_run" <?= $point['type'] == 'cable_run' ? 'selected' : '' ?>>Кабель</option>
                <option value="patch_cord" <?= $point['type'] == 'patch_cord' ? 'selected' : '' ?>>Патч-корд</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Расположение</label>
            <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($point['location'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Статус *</label>
            <select name="status" class="form-select" required>
                <option value="active" <?= $point['status'] == 'active' ? 'selected' : '' ?>>Активна</option>
                <option value="defect" <?= $point['status'] == 'defect' ? 'selected' : '' ?>>Дефект</option>
                <option value="decommissioned" <?= $point['status'] == 'decommissioned' ? 'selected' : '' ?>>Списана</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Дата последней проверки</label>
            <input type="date" name="last_check" class="form-control" value="<?= htmlspecialchars($point['last_check'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="inventory.php" class="btn btn-secondary">Отмена</a>
        </div>
    </form>
</div>