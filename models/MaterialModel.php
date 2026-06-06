<?php
function getAllMaterialsUsage($pdo) {
    $stmt = $pdo->query("
        SELECT 
            mu.id,
            mu.material_id,
            mu.quantity,
            mu.point_id,
            mu.defect_id,
            mu.used_by,
            mu.used_at,
            mu.comment,
            m.name AS material_name,
            m.unit AS material_unit,
            u.login AS user_name,
            np.label AS point_label,
            d.description AS defect_description
        FROM material_usage mu
        LEFT JOIN materials m ON mu.material_id = m.id
        LEFT JOIN users u ON mu.used_by = u.id
        LEFT JOIN network_points np ON mu.point_id = np.id
        LEFT JOIN defects d ON mu.defect_id = d.id
        ORDER BY mu.used_at DESC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getMaterialUsageById($pdo, $id) {
    $stmt = $pdo->prepare("
        SELECT mu.*, m.name as material_name, m.unit, u.login as user_name
        FROM material_usage mu
        LEFT JOIN materials m ON mu.material_id = m.id
        LEFT JOIN users u ON mu.used_by = u.id
        WHERE mu.id = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addMaterialUsage($pdo, $data) {
    $stmt = $pdo->prepare("
        INSERT INTO material_usage (material_id, quantity, point_id, defect_id, used_by, comment, used_at)
        VALUES (?, ?, ?, ?, ?, ?, NOW())
    ");
    return $stmt->execute([
        $data['material_id'],
        $data['quantity'],
        $data['point_id'] ?: null,
        $data['defect_id'] ?: null,
        $data['used_by'],
        $data['comment']
    ]);
}

function updateMaterialUsage($pdo, $id, $data) {
    $stmt = $pdo->prepare("
        UPDATE material_usage 
        SET material_id = ?, quantity = ?, point_id = ?, defect_id = ?, used_by = ?, comment = ?
        WHERE id = ?
    ");
    return $stmt->execute([
        $data['material_id'],
        $data['quantity'],
        $data['point_id'] ?: null,
        $data['defect_id'] ?: null,
        $data['used_by'],
        $data['comment'],
        $id
    ]);
}

function deleteMaterialUsage($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM material_usage WHERE id = ?");
    return $stmt->execute([$id]);
}
function getMaterialsList($pdo) {
    $stmt = $pdo->query("SELECT id, name, unit FROM materials ORDER BY name");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getDefectsList($pdo) {
    $stmt = $pdo->query("
        SELECT d.id, d.description, np.label as point_label
        FROM defects d
        LEFT JOIN network_points np ON d.point_id = np.id
        WHERE d.status != 'closed'
        ORDER BY d.id DESC
        LIMIT 50
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getAllUsersList($pdo) {
    $stmt = $pdo->query("SELECT id, login FROM users ORDER BY login");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
