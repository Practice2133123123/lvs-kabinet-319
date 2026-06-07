<?php
function getFilteredReportData($pdo, $filters) {
    $sql = "
        SELECT 
            mu.id,
            m.name as material_name,
            mu.quantity,
            mu.used_at,
            mu.comment,
            CASE 
                WHEN mu.point_id IS NOT NULL THEN 'Точка'
                WHEN mu.defect_id IS NOT NULL THEN 'Дефект'
                ELSE 'Общий'
            END as section,
            CASE 
                WHEN mu.point_id IS NOT NULL THEN np.label
                WHEN mu.defect_id IS NOT NULL THEN d.description
                ELSE '-'
            END as section_name,
            u.login as user_name,
            np.status as point_status,
            d.status as defect_status
        FROM material_usage mu
        LEFT JOIN materials m ON mu.material_id = m.id
        LEFT JOIN network_points np ON mu.point_id = np.id
        LEFT JOIN defects d ON mu.defect_id = d.id
        LEFT JOIN users u ON mu.used_by = u.id
        WHERE 1=1
    ";
    
    $params = [];
    
    if (!empty($filters['date_from'])) {
        $sql .= " AND DATE(mu.used_at) >= :date_from";
        $params[':date_from'] = $filters['date_from'];
    }
    
    if (!empty($filters['date_to'])) {
        $sql .= " AND DATE(mu.used_at) <= :date_to";
        $params[':date_to'] = $filters['date_to'];
    }
    
    if (!empty($filters['section'])) {
        if ($filters['section'] == 'point') {
            $sql .= " AND mu.point_id IS NOT NULL";
        } elseif ($filters['section'] == 'defect') {
            $sql .= " AND mu.defect_id IS NOT NULL";
        }
    }
    
    if (!empty($filters['type'])) {
        $sql .= " AND m.type = :type";
        $params[':type'] = $filters['type'];
    }
    
    if (!empty($filters['point_status'])) {
        $sql .= " AND np.status = :point_status";
        $params[':point_status'] = $filters['point_status'];
    }
    
    if (!empty($filters['defect_status'])) {
        $sql .= " AND d.status = :defect_status";
        $params[':defect_status'] = $filters['defect_status'];
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

function getSections($pdo) {
    return [
        ['value' => 'point', 'label' => 'Точки'],
        ['value' => 'defect', 'label' => 'Дефекты']
    ];
}

function getPointStatuses($pdo) {
    return [
        ['value' => 'active', 'label' => 'Активна'],
        ['value' => 'defect', 'label' => 'Дефект'],
        ['value' => 'decommissioned', 'label' => 'Списана']
    ];
}

function getDefectStatuses($pdo) {
    return [
        ['value' => 'open', 'label' => 'Открыт'],
        ['value' => 'in_progress', 'label' => 'В работе'],
        ['value' => 'closed', 'label' => 'Закрыт']
    ];
}