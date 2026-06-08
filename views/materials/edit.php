<?php include '../views/layouts/header.php'; ?>

<div class="container mt-4" style="max-width: 600px;">
    <h2>Редактирование расхода материалов #<?= htmlspecialchars($item['id']) ?></h2>
    
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Материал *</label>
            <select name="material_id" class="form-control" required>
                <option value="">Выберите материал</option>
                <?php foreach ($materials as $m): ?>
                    <option value="<?= $m['id'] ?>" <?= ($m['id'] == $item['material_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($m['name']) ?> (<?= htmlspecialchars($m['unit']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Количество *</label>
            <input type="number" step="0.01" name="quantity" class="form-control" required 
                   value="<?= htmlspecialchars($item['quantity']) ?>">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Сетевая точка</label>
            <select name="point_id" class="form-control">
                <option value="">Не указана</option>
                <?php foreach ($points as $p): ?>
                    <option value="<?= $p['id'] ?>" <?= ($p['id'] == $item['point_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($p['label']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Дефект</label>
            <select name="defect_id" class="form-control">
                <option value="">Не указан</option>
                <?php foreach ($defects as $d): ?>
                    <option value="<?= $d['id'] ?>" <?= ($d['id'] == $item['defect_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($d['point_label']) ?> - <?= htmlspecialchars($d['description']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Кто использовал</label>
            <select name="used_by" class="form-control">
                <option value="">Не указан</option>
                <?php foreach ($users as $u): ?>
                    <option value="<?= $u['id'] ?>" <?= ($u['id'] == $item['used_by']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($u['login']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Комментарий</label>
            <textarea name="comment" class="form-control" rows="3"><?= htmlspecialchars($item['comment'] ?? '') ?></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="../materials/materials.php" class="btn btn-secondary">Отмена</a>
    </form>
</div>

<?php include '../views/layouts/footer.php'; ?>