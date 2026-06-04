<?php

// Получить все расходы с фильтрацией
function getAllMaterialsUsage($pdo, $date_from = '', $date_to = '', $material_id = '') {
    $sql = "SELECT 
                material_usage.*,
                materials.name AS material_name,
                materials.type AS material_type,
                users.login AS user_name,
                network_points.label AS point_label
            FROM material_usage
            LEFT JOIN materials ON material_usage.material_id = materials.id
            LEFT JOIN users ON material_usage.used_by = users.id
            LEFT JOIN network_points ON material_usage.point_id = network_points.id
            WHERE 1=1";

    $params = [];

    if (!empty($date_from)) {
        $sql .= " AND DATE(material_usage.used_at) >= :date_from";
        $params[':date_from'] = $date_from;
    }

    if (!empty($date_to)) {
        $sql .= " AND DATE(material_usage.used_at) <= :date_to";
        $params[':date_to'] = $date_to;
    }

    if (!empty($material_id)) {
        $sql .= " AND material_usage.material_id = :material_id";
        $params[':material_id'] = $material_id;
    }

    $sql .= " ORDER BY material_usage.used_at DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
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
    $stmt = $pdo->query("SELECT id, name, type FROM materials ORDER BY name");
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

// Получить тип материала по ID (нужна для подсчёта сводки)
function getMaterialTypeById($pdo, $material_id) {
    if (!$material_id) return '';
    $stmt = $pdo->prepare("SELECT type FROM materials WHERE id = ?");
    $stmt->execute([$material_id]);
    $row = $stmt->fetch();
    return $row ? $row['type'] : '';
}