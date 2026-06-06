<?php include '../views/layouts/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">Журнал расходов материалов</h1>
    
    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
        <div class="alert alert-success">Расход материала успешно удалён!</div>
    <?php endif; ?>
    
    <?php if (empty($items)): ?>
        <p>Нет данных</p>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Материал</th>
                        <th>Количество</th>
                        <th>Ед.изм.</th>
                        <th>Точка</th>
                        <th>Дефект</th>
                        <th>Кто использовал</th>
                        <th>Дата</th>
                        <th>Комментарий</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['id'] ?? '') ?></td>
                        <td><?= htmlspecialchars($item['material_name'] ?? '') ?></td>
                        <td><?= htmlspecialchars($item['quantity'] ?? '') ?></td>
                        <td><?= htmlspecialchars($item['material_unit'] ?? '') ?></td>
                        <td><?= htmlspecialchars($item['point_label'] ?? '—') ?></td>
                        <td><?= htmlspecialchars($item['defect_description'] ?? '—') ?></td>
                        <td><?= htmlspecialchars($item['user_name'] ?? '—') ?></td>
                        <td><?= htmlspecialchars($item['used_at'] ?? '') ?></td>
                        <td><?= htmlspecialchars($item['comment'] ?? '—') ?></td>
                        <td>
                            <a href="material_edit.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-warning">Изменить</a>
                            <a href="material_delete.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Удалить расход?')">Удалить</a>
                </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    
    <div class="mt-3">
        <a href="materials_add.php" class="btn btn-primary">Добавить расход</a>
        <a href="index.php" class="btn btn-secondary">Назад</a>
    </div>
</div>

<?php include '../views/layouts/footer.php'; ?>