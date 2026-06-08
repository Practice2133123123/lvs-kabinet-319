<div class="filter-dropdown">
    <button class="filter-btn" onclick="toggleFilter()"> Фильтры</button>
    <div id="filterMenu" class="filter-menu" style="display: none;">
        <form method="GET" action="">
            <div class="filter-group">
                <label>Критичность:</label>
                <select name="severity">
                    <option value="">Все</option>
                    <option value="high">Высокая</option>
                    <option value="medium">Средняя</option>
                    <option value="low">Низкая</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Статус:</label>
                <select name="status">
                    <option value="">Все</option>
                    <option value="open">Открыт</option>
                    <option value="in_progress">В работе</option>
                    <option value="closed">Закрыт</option>
                </select>
            </div>
            <div class="filter-group">
                <button type="submit">Применить</button>
                <a href="defects.php">Сбросить</a>
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