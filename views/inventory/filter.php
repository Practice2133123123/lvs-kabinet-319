<div class="filter-dropdown">
    <button class="filter-btn" onclick="toggleFilter()"> Фильтры</button>
    <div id="filterMenu" class="filter-menu" style="display: none;">
        <form method="GET" action="">
            <div class="filter-group">
                <label>Тип точки:</label>
                <select name="type">
                    <option value="">Все типы</option>
                    <option value="socket">Розетка</option>
                    <option value="switch">Коммутатор</option>
                    <option value="cable_run">Кабель</option>
                    <option value="patch_cord">Патч-корд</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Статус:</label>
                <select name="status">
                    <option value="">Все статусы</option>
                    <option value="active">Активна</option>
                    <option value="defect">Дефект</option>
                    <option value="decommissioned">Списана</option>
                </select>
            </div>
            <div class="filter-group">
                <button type="submit">Применить</button>
                <a href="/public/inventory.php">Сбросить</a>
            </div>
        </form>
    </div>
</div>