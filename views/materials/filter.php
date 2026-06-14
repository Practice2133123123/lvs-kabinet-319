<div class="filter-dropdown">
    <button class="btn btn-secondary" onclick="toggleFilter('matFilter')">Фильтры</button>
    <div id="matFilter" class="filter-menu hidden">
        <form method="GET" action="">
            <div class="filter-group">
                <label>Дата с:</label>
                <input type="date" name="date_from" value="<?= htmlspecialchars($date_from) ?>">
            </div>
            <div class="filter-group">
                <label>Дата по:</label>
                <input type="date" name="date_to" value="<?= htmlspecialchars($date_to) ?>">
            </div>
            <div class="filter-group">
                <label>Материал:</label>
                <select name="material_id">
                    <option value="">Все</option>
                    <?php foreach ($materialsList as $m): ?>
                        <option value="<?= $m['id'] ?>" <?= $material_id == $m['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($m['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filter-group">
                <button type="submit" class="btn btn-primary">Применить</button>
                <a href="materials.php" class="btn btn-secondary" style="margin-left: 8px;">Сбросить</a>
            </div>
        </form>
    </div>
</div>
