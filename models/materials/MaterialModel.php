<?php
// Получить все расходы с JOIN (для общего списка или отчетов)
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

// Получить конкретную запись расхода для редактирования
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

// Добавить расход
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

// Обновить расход
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

// Удалить расход
function deleteMaterialUsage($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM material_usage WHERE id = ?");
    return $stmt->execute([$id]);
}

// Вспомогательные списки для выпадающих меню
function getMaterialsList($pdo) {
    $stmt = $pdo->query("SELECT id, name, unit FROM materials ORDER BY name");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllUsersList($pdo) {
    $stmt = $pdo->query("SELECT id, login FROM users ORDER BY login");
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

// Пагинация и фильтры (из develop)
function getMaterialsUsageWithPagination($pdo, $limit, $offset, $date_from = '', $date_to = '', $material_id = '') {
    $sql = "SELECT 
                material_usage.id,
                material_usage.quantity,
                material_usage.point_id,
                material_usage.defect_id,
                material_usage.used_by,
                material_usage.used_at,
                material_usage.comment,
                materials.name AS material_name,
                materials.type AS material_type,
                materials.unit AS unit,
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

    $sql .= " ORDER BY material_usage.used_at DESC LIMIT :limit OFFSET :offset";

    $stmt = $pdo->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countAllMaterialsUsage($pdo, $date_from = '', $date_to = '', $material_id = '') {
    $sql = "SELECT COUNT(*) FROM material_usage WHERE 1=1";
    $params = [];

    if (!empty($date_from)) {
        $sql .= " AND DATE(used_at) >= :date_from";
        $params[':date_from'] = $date_from;
    }
    if (!empty($date_to)) {
        $sql .= " AND DATE(used_at) <= :date_to";
        $params[':date_to'] = $date_to;
    }
    if (!empty($material_id)) {
        $sql .= " AND material_id = :material_id";
        $params[':material_id'] = $material_id;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchColumn();
}
?>