<?php 
include '../views/layouts/header.php'; 
?>

 ntainer mt-4">
        <h1 class="mb-4">Сетевые точки</h1>
        <!-- Собщение об успешном обновлении для пользователя -->
<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <p style="color: green;">Точка успешно обновлена!</p>
<?php endif; ?>

        <!-- Кнопка фильтров -->
        <div style="margin-bottom: 20px;">
            <button onclick="toggleFilter()" style="padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">
                 Фильтры
            </button>
            <div id="filterMenu" style="display: none; margin-top: 10px; padding: 15px; border: 1px solid #ccc; background: #f9f9f9; border-radius: 5px;">
                <form method="GET" action="">
                    <div style="margin-bottom: 10px;">
                        <label>Тип точки:</label>
                        <select name="type">
                            <option value="">Все типы</option>
                            <option value="socket">Розетка</option>
                            <option value="switch">Коммутатор</option>
                            <option value="cable_run">Кабель</option>
                            <option value="patch_cord">Патч-корд</option>
                        </select>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <label>Статус:</label>
                        <select name="status">
                            <option value="">Все статусы</option>
                            <option value="active">Активна</option>
                            <option value="defect">Дефект</option>
                            <option value="decommissioned">Списана</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit">Применить</button>
                        <a href="inventory.php">Сбросить</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Таблица -->
        <div class="table-responsive">
<<<<<<< HEAD
            <table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse;">
                <thead style="background: #f0f0f0;">
=======
            <table class="table table-striped table-hover">
                <thead class="table-dark">

                
>>>>>>> dc38333d443785fcc3bba21a74c498e51dd4f5fa
                <tr>
                    <th>Метка</th>
                    <th>Тип</th>
                    <th>Расположение</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                <?php if (count($points) > 0): ?>
                    <?php foreach ($points as $point): ?>
                        <tr>
                            <td><?= htmlspecialchars($point['label']) ?></td>
                            <td><?= htmlspecialchars($point['type']) ?></td>
                            <td><?= htmlspecialchars($point['location'] ?? '—') ?></td>
                            <td><?= htmlspecialchars($point['status']) ?></td>
                            <td>
<<<<<<< HEAD
                                <a href="point_edit.php?id=<?= $point['id'] ?>">️ Ред.</a>
                                <a href="point_delete.php?id=<?= $point['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Удалить точку?')">Удалить</a>

=======
                                <?php
                                $statusLabels = [
                                        'active' => 'Активна',
                                        'defect' => 'Дефект',
                                        'decommissioned' => 'Списана'
                                ];
                                $label = $statusLabels[$point['status']] ?? $point['status'];
                                ?>
                                <span class="badge status-<?= htmlspecialchars($point['status']) ?>">
                                    <?= htmlspecialchars($label) ?>
                                </span>
                                <td> <a href="point_edit.php?id=<?= $point['id'] ?>">Изменить точку</a></td>
>>>>>>> dc38333d443785fcc3bba21a74c498e51dd4f5fa
                            </td>
                        </tr>

                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Нет данных</td>
                    </tr>
                <?php endif; ?>

            </table>  
            <a href="point_add.php?id=<?= $point['id'] ?>" class="btn btn-sm btn-secondary" >Добавить сетевую точку</a>              
        </tbody>

        </div>
    </div>

    <script>
        function toggleFilter() {
            var menu = document.getElementById('filterMenu');
            if (menu.style.display === 'none') {
                menu.style.display = 'block';
            } else {
                menu.style.display = 'none';
            }
        }
    </script>

<?php include '../views/layouts/footer.php'; ?>