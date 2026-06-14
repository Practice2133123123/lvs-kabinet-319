<div class="filter-dropdown">
    <button class="btn btn-secondary" onclick="toggleFilter('invFilter')">Фильтры</button>
    <div id="invFilter" class="filter-menu hidden">
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
                <button type="submit" class="btn btn-primary">Применить</button>
                <a href="inventory.php" class="btn btn-secondary" style="margin-left: 8px;">Сбросить</a>
            </div>
        </form>
    </div>
</div>
