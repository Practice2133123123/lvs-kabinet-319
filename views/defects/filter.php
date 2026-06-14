<div class="filter-dropdown">
    <button class="btn btn-secondary" onclick="toggleFilter('defFilter')">Фильтры</button>
    <div id="defFilter" class="filter-menu hidden">
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
                <button type="submit" class="btn btn-primary">Применить</button>
                <a href="defects.php" class="btn btn-secondary" style="margin-left: 8px;">Сбросить</a>
            </div>
        </form>
    </div>
</div>
