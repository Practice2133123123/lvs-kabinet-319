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
function getMaterialsList($pdo)
{
    $stmt = $pdo->query("SELECT id, name, type, unit FROM materials ORDER BY name");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
