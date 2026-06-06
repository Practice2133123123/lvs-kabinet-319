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

function getDefectsWithPagination($pdo, $limit, $offset) {
    $stmt = $pdo->prepare("
        SELECT defects.id, network_points.label AS network_label,
               defects.category, defects.severity, defects.status
        FROM network_points
        JOIN defects ON defects.point_id = network_points.id
        ORDER BY defects.id DESC
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countAllDefects($pdo) {
    return $pdo->query("SELECT COUNT(*) FROM defects")->fetchColumn();
}

// Подсчёт дефектов по статусу
function countDefectsByStatus($pdo, $status) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM defects WHERE status = ?");
    $stmt->execute([$status]);
    return $stmt->fetchColumn();
}

// Получить все статусы и их количество
function getDefectStatusCounts($pdo) {
    $stmt = $pdo->query("
        SELECT status, COUNT(*) as count 
        FROM defects 
        GROUP BY status
    ");
    return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
}