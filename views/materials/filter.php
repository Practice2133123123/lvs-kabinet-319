<div class="filter-dropdown">
    <button class="filter-btn" onclick="toggleFilter()">🔽 Фильтры</button>
    <div id="filterMenu" class="filter-menu" style="display: none;">
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
                <button type="submit">Применить</button>
                <a href="materials.php">Сбросить</a>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleFilter() {
        var menu = document.getElementById('filterMenu');
        if (menu.style.display === 'none' || menu.style.display === '') {
            menu.style.display = 'block';
        } else {
            menu.style.display = 'none';
        }
    }
</script>