<?php

require_once __DIR__ . '/../config/db.php'; 

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $label = isset($_POST['label']) ? trim($_POST['label']) : '';
    $type = isset($_POST['type']) ? trim($_POST['type']) : '';
    $location = isset($_POST['location']) ? trim($_POST['location']) : '';
    $status = isset($_POST['status']) ? trim($_POST['status']) : '';
    $check_date = !empty($_POST['last_check']) ? $_POST['last_check'] : null;

    
    $allowed_types = ['socket', 'switch', 'cable_run', 'patch_cord'];
    if (!in_array($type, $allowed_types)) {
        $errors[] = "Выбран некорректный тип точки.";
    }

    $allowed_statuses = ['active', 'defect', 'decommissioned'];
    if (!in_array($status, $allowed_statuses)) {
        $errors[] = "Выбран некорректный статус.";
    }

    if (empty($errors)) {
        try {
    $sql = "INSERT INTO network_points (label, type, location, status, last_check) 
    VALUES (:label, :type, :location, :status, :last_check)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':label' => $label,
        ':type' => $type,
        ':location' => $location,
        ':status' => $status,
        ':last_check' => $check_date
    ]);
header("Location: inventory.php");
exit;
        } catch (PDOException $e) {
            $errors[] = "Ошибка при сохранении в базу данных: " . $e->getMessage();
        }
    }
}

include __DIR__ . '/../includes/header.php';
?>

<div class="container" 
style="max-width: 600px; 
margin-top: 30px;">

    <h2>Добавление новой сетевой точки</h2>

    <?php if (!empty($errors)): ?>
        <div style="color: red; background: #f8d7da; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
            <ul>
                <?php foreach ($errors as $error): ?>
                <th><?= htmlspecialchars($error) ?></th>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

<form action="inventory.php" method="POST">

    <div style="margin-bottom: 15px;">

        <label for="label">Метка *</label><br>
            <input type="text" id="label" name="label" required style="width: 100%; padding: 8px;" value="<?= isset($label) ? htmlspecialchars($label) : '' ?>">
    </div>
            
    <div style="margin-bottom: 15px;">
        <label for="type">Тип *</label><br>
        <select id="type" name="type" required style="width: 100%; padding: 8px;">
            <ul>     
                //Мы проверяем: «Существует ли переменная $type и равна ли она строке 'socket'?»                                              
                //Если ДА (?): Возвращается строка 'selected'.
                //Если НЕТ (:): Возвращается пустая строка ''.
                <option value="socket" <?= (isset($type) && $type === 'socket') ? 'selected' : '' ?>>Socket</option>
                <option value="switch" <?= (isset($type) && $type === 'switch') ? 'selected' : '' ?>>Switch</option>
                <option value="cable_run" <?= (isset($type) && $type === 'cable_run') ? 'selected' : '' ?>>Cable run</option>
                <option value="patch_cord" <?= (isset($type) && $type === 'patch_cord') ? 'selected' : '' ?>>Patch cord</option>
            </ul>
        </select>
        </div>

        <div style="margin-bottom: 15px;">
        <label for="location">Расположение</label><br>
        <input type="text" id="location" name="location" style="width: 100%; padding: 8px;" value="<?= isset($location) ? htmlspecialchars($location) : '' ?>">
        </div>

        <div style="margin-bottom: 15px;">
        <label for="status">Статус *</label><br>
        <select id="status" name="status" required style="width: 100%; padding: 8px;">
                <option value="active" <?= (isset($status) && $status === 'active') ? 'selected' : '' ?>>Active</option>
                <option value="defect" <?= (isset($status) && $status === 'defect') ? 'selected' : '' ?>>Defect</option>
                <option value="decommissioned" <?= (isset($status) && $status === 'decommissioned') ? 'selected' : '' ?>>Decommissioned</option>
        </select>
        </div>

        <div style="margin-bottom: 20px;">
        <label for="last_check">Дата проверки</label><br>
        <input type="date" id="last_check" name="last_check" style="width: 100%; padding: 8px;" value="<?= isset($last_check) ? htmlspecialchars($last_check) : '' ?>">
        </div>
        <button type="submit" >Сохранить</button>
        <a href="inventory.php" >Отмена</a>
    </form>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
?>