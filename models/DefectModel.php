<?php
function getAllDefects($pdo, $severity = '', $status = '') {
    $sql = "
        SELECT defects.id, network_points.label AS network_label,
               defects.category, defects.severity, defects.status
        FROM network_points
        JOIN defects ON defects.point_id = network_points.id
        WHERE 1=1
    ";
    $params = [];

    if (!empty($severity)) {
        $sql .= " AND defects.severity = :severity";
        $params[':severity'] = $severity;
    }

    if (!empty($status)) {
        $sql .= " AND defects.status = :status";
        $params[':status'] = $status;
    }

    $sql .= " ORDER BY defects.id DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}