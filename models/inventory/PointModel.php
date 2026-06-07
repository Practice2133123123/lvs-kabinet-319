<?php

function countPointsByStatus($pdo, $status) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM network_points WHERE status = ?");
    $stmt->execute([$status]);
    return $stmt->fetchColumn();
}

function getPointStatusCounts($pdo) {
    $stmt = $pdo->query("
        SELECT status, COUNT(*) as count 
        FROM network_points 
        GROUP BY status
    ");
    return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
}

function getAllPoints($pdo) {
    $stmt = $pdo->query("SELECT id, label, type, status FROM network_points");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countAllPoints($pdo) {
    return $pdo->query("SELECT COUNT(*) FROM network_points")->fetchColumn();
}

function getPointsWithPagination($pdo, $limit, $offset) {
    $stmt = $pdo->prepare("
        SELECT id, label, type, status 
        FROM network_points 
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function filterPoints($pdo, $type = '', $status = '') {
    $sql = "SELECT id, label, type, status FROM network_points WHERE 1=1";
    $params = [];

    if (!empty($type)) {
        $sql .= " AND type = :type";
        $params[':type'] = $type;
    }

    if (!empty($status)) {
        $sql .= " AND status = :status";
        $params[':status'] = $status;
    }

    $sql .= " ORDER BY id DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPointById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM network_points WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addPoint($pdo, $data) {
    $stmt = $pdo->prepare("
        INSERT INTO network_points (label, type, location, status, created_by, created_at)
        VALUES (?, ?, ?, ?, ?, NOW())
    ");
    return $stmt->execute([
        $data['label'],
        $data['type'],
        $data['location'] ?? null,
        $data['status'] ?? 'active',
        $data['created_by']
    ]);
}

function updatePoint($pdo, $id, $data) {
    $stmt = $pdo->prepare("
        UPDATE network_points 
        SET label = ?, type = ?, location = ?, status = ?, updated_at = NOW()
        WHERE id = ?
    ");
    return $stmt->execute([
        $data['label'],
        $data['type'],
        $data['location'] ?? null,
        $data['status'],
        $id
    ]);
}

function hasDefects($pdo, $point_id) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM defects WHERE point_id = ?");
    $stmt->execute([$point_id]);
    return $stmt->fetchColumn() > 0;
}

function deletePoint($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM network_points WHERE id = ?");
    return $stmt->execute([$id]);
}
?>