<?php include __DIR__ . '/../../views/layouts/header.php'; ?>

    <div class="container" style="max-width: 600px; margin-top: 30px;">
        <h2>Добавление новой сетевой точки</h2>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?=  htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="point_add.php" method="POST">
            <?= csrfField() ?>
            <div class="form-group">
                <label for="label">Метка *</label>
                <input type="text" id="label" name="label" required class="form-control" value="<?= htmlspecialchars($data['label'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="type">Тип *</label>
                <select id="type" name="type" required class="form-control">
                    <option value="socket" <?= (isset($data['type']) && $data['type'] === 'socket') ? 'selected' : '' ?>>Socket</option>
                    <option value="switch" <?= (isset($data['type']) && $data['type'] === 'switch') ? 'selected' : '' ?>>Switch</option>
                    <option value="cable_run" <?= (isset($data['type']) && $data['type'] === 'cable_run') ? 'selected' : '' ?>>Cable run</option>
                    <option value="patch_cord" <?= (isset($data['type']) && $data['type'] === 'patch_cord') ? 'selected' : '' ?>>Patch cord</option>
                </select>
            </div>

            <div class="form-group">
                <label for="location">Расположение</label>
                <input type="text" id="location" name="location" class="form-control" value="<?= htmlspecialchars($data['location'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="status">Статус *</label>
                <select id="status" name="status" required class="form-control">
                    <option value="active" <?= (isset($data['status']) && $data['status'] === 'active') ? 'selected' : '' ?>>Active</option>
                    <option value="defect" <?= (isset($data['status']) && $data['status'] === 'defect') ? 'selected' : '' ?>>Defect</option>
                    <option value="decommissioned" <?= (isset($data['status']) && $data['status'] === 'decommissioned') ? 'selected' : '' ?>>Decommissioned</option>
                </select>
            </div>

            <div class="form-group">
                <label for="last_check">Дата проверки</label>
                <input type="date" id="last_check" name="last_check" class="form-control" value="<?= htmlspecialchars($data['last_check'] ?? '') ?>">
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="inventory.php" class="btn btn-secondary">Отмена</a>
        </form>
    </div>

<?php include __DIR__ . '/../../views/layouts/footer.php'; ?>
