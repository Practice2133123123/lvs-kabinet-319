<?php
// Получить все дефекты
function getAllDefects($pdo) {
    $stmt = $pdo->query("
        SELECT d.*, np.label as point_label, u.login as created_by_name
        FROM defects d
        LEFT JOIN network_points np ON d.point_id = np.id
        LEFT JOIN users u ON d.created_by = u.id
        ORDER BY d.created_at DESC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Получить дефект по ID
function getDefectById($pdo, $id) {
    $stmt = $pdo->prepare("
        SELECT d.*, np.label as point_label
        FROM defects d
        LEFT JOIN network_points np ON d.point_id = np.id
        WHERE d.id = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Создать дефект
function createDefect($pdo, $data, $created_by) {
    $stmt = $pdo->prepare("
        INSERT INTO defects (point_id, category, severity, description, status, created_by, created_at)
        VALUES (?, ?, ?, ?, ?, ?, NOW())
    ");
    return $stmt->execute([
        $data['point_id'],
        $data['category'],
        $data['severity'],
        $data['description'],
        $data['status'],
        $created_by
    ]);
}

// Обновить дефект
function updateDefect($pdo, $id, $data) {
    $stmt = $pdo->prepare("
        UPDATE defects 
        SET point_id = ?, category = ?, severity = ?, description = ?, status = ?
        WHERE id = ?
    ");
    return $stmt->execute([
        $data['point_id'],
        $data['category'],
        $data['severity'],
        $data['description'],
        $data['status'],
        $id
    ]);
}

// Удалить дефект
function deleteDefect($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM defects WHERE id = ?");
    return $stmt->execute([$id]);
}

// Проверить, есть ли расходники у дефекта
function hasMaterialUsage($pdo, $defect_id) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM material_usage WHERE defect_id = ?");
    $stmt->execute([$defect_id]);
    return $stmt->fetchColumn() > 0;
}
?>