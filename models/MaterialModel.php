<?php
// Получить все расходы с JOIN
function getAllMaterialsUsage($pdo) {
    $stmt = $pdo->query("
        SELECT 
            mu.id,
            mu.quantity,
            mu.point_id,
            mu.defect_id,
            mu.used_by,
            mu.created_by,
            mu.used_at,
            mu.comment,
            m.name AS material_name,
            u_used.login AS user_name,
            u_created.login AS created_by_name,
            np.label AS point_label
        FROM material_usage mu
        LEFT JOIN materials m ON mu.material_id = m.id
        LEFT JOIN users u_used ON mu.used_by = u_used.id
        LEFT JOIN users u_created ON mu.created_by = u_created.id
        LEFT JOIN network_points np ON mu.point_id = np.id
        ORDER BY mu.used_at DESC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Добавить расход
function addMaterialUsage($pdo, $data) {
    $stmt = $pdo->prepare("
        INSERT INTO material_usage (material_id, quantity, point_id, defect_id, used_by, created_by, comment, used_at)
        VALUES (:material_id, :quantity, :point_id, :defect_id, :used_by, :created_by, :comment, NOW())
    ");
    return $stmt->execute([
        ':material_id' => $data['material_id'],
        ':quantity' => $data['quantity'],
        ':point_id' => $data['point_id'] ?: null,
        ':defect_id' => $data['defect_id'] ?: null,
        ':used_by' => $data['used_by'],
        ':created_by' => $_SESSION['user_id'] ?? $data['used_by'],
        ':comment' => $data['comment']
    ]);
}

// Список материалов для выпадающего списка
function getMaterialsList($pdo) {
    $stmt = $pdo->query("SELECT id, name FROM materials ORDER BY name");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Список пользователей для выпадающего списка
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