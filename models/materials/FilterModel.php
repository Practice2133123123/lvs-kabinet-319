<?php

// Фильтрация материалов (по дате и материалу)
function filterMaterials($pdo, $date_from = '', $date_to = '', $material_id = '')
{
    $sql = "SELECT 
                material_usage.*,
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

    $sql .= " ORDER BY material_usage.used_at DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Получить список материалов для выпадающего списка
// function getMaterialsList($pdo)
// {
//     $stmt = $pdo->query("SELECT id, name, type, unit FROM materials ORDER BY name");
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

// Фильтр для отчетности всех таблиц

function getFilteredData($pdo, $date_from = '', $date_to = '', $material_id = '') {
    $sql = "
        SELECT 
            mu.id,
            m.name as material_name,
            mu.quantity,
            mu.used_at,
            mu.comment,
            np.label as point_label,
            d.description as defect_description,
            u.login as user_name,
            mu.status
        FROM material_usage mu
        LEFT JOIN materials m ON mu.material_id = m.id
        LEFT JOIN network_points np ON mu.point_id = np.id
        LEFT JOIN defects d ON mu.defect_id = d.id
        LEFT JOIN users u ON mu.used_by = u.id
        WHERE 1=1
    ";
    
    $params = [];
    
    // Фильтр по дате с
    if (!empty($date_from)) {
        $sql .= " AND DATE(mu.used_at) >= :date_from ";
        $params[':date_from'] = $date_from;
    }
    
    // Фильтр по дате по
    if (!empty($date_to)) {
        $sql .= " AND DATE(mu.used_at) <= :date_to";
        $params[':date_to'] = $date_to;
    }
    
    // Фильтр по типу материала
    if (!empty($material_id)) {
        $sql .= " AND m.type = :material_id";
        $params[':material_id'] = $material_id;
    }
    
    $sql .= " ORDER BY mu.used_at DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getMaterialTypes($pdo) {
    $stmt = $pdo->query("SELECT DISTINCT type FROM materials ORDER BY type");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getStatuses($pdo) {
    return [
        ['status' => 'active', 'label' => 'Активен'],
        ['status' => 'defect', 'label' => 'Дефект'],
        ['status' => 'decommissioned', 'label' => 'Списан']
    ];
}

function getSections($pdo) {
    return [
        ['section' => 'point', 'label' => 'Точки'],
        ['section' => 'defect', 'label' => 'Дефекты']
    ];
}
