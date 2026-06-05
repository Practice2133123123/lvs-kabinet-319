<?php

// Получить все расходы с JOIN
function getAllMaterialsUsage($pdo) {
    $stmt = $pdo->query("
        SELECT 
            material_usage.id,
            material_usage.quantity,
            material_usage.point_id,
            material_usage.defect_id,
            material_usage.used_by,
            material_usage.used_at,
            material_usage.comment,
            materials.name AS material_name,
            users.login AS user_name,
            network_points.label AS point_label
        FROM material_usage
        LEFT JOIN materials ON material_usage.material_id = materials.id
        LEFT JOIN users ON material_usage.used_by = users.id
        LEFT JOIN network_points ON material_usage.point_id = network_points.id
        ORDER BY material_usage.used_at DESC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Добавить расход
function addMaterialUsage($pdo, $data) {
    $stmt = $pdo->prepare("
        INSERT INTO material_usage (material_id, quantity, point_id, defect_id, used_by, comment, used_at)
        VALUES (:material_id, :quantity, :point_id, :defect_id, :used_by, :comment, NOW())
    ");
    return $stmt->execute([
        ':material_id' => $data['material_id'],
        ':quantity' => $data['quantity'],
        ':point_id' => $data['point_id'] ?: null,
        ':defect_id' => $data['defect_id'] ?: null,
        ':used_by' => $data['used_by'],
        ':comment' => $data['comment']
    ]);
}

// Список материалов для выпадающего списка
function getMaterialsList($pdo) {
    $stmt = $pdo->query("SELECT id, name FROM materials ORDER BY name");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Список пользователей для выпадающего списка
function getUsersList($pdo) {
    $stmt = $pdo->query("SELECT id, login FROM users ORDER BY login");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Список точек для выпадающего списка
function getPointsList($pdo) {
    $stmt = $pdo->query("SELECT id, label FROM network_points ORDER BY label");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Список дефектов для выпадающего списка
function getDefectsList($pdo) {
    $stmt = $pdo->query("
        SELECT id, description 
        FROM defects 
        WHERE status != 'closed'
        ORDER BY id DESC
        LIMIT 20
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
