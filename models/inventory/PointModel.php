<?php
function getAllPoints($pdo) {
    $stmt = $pdo->query("SELECT * FROM network_points ORDER BY label");
    return $stmt->fetchAll();
}

function getPointById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM network_points WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createPoint($pdo, $data) {
    $sql = "INSERT INTO network_points (label, type, location, status, last_check) 
            VALUES (:label, :type, :location, :status, :last_check)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':label' => $data['label'],
        ':type' => $data['type'],
        ':location' => $data['location'],
        ':status' => $data['status'],
        ':last_check' => $data['last_check']
    ]);
}

function updatePoint($pdo, $id, $data) {
    $stmt = $pdo->prepare("
        UPDATE network_points 
        SET label = :label, 
            type = :type, 
            location = :location, 
            status = :status, 
            last_check = :last_check
        WHERE id = :id
    ");
    return $stmt->execute([
        ':id' => $id,
        ':label' => $data['label'],
        ':type' => $data['type'],
        ':location' => $data['location'],
        ':status' => $data['status'],
        ':last_check' => $data['last_check'] ?? null
    ]);
}

function hasDefects($pdo, $point_id) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM defects WHERE point_id = ?");
    $stmt->execute([$point_id]);
    return $stmt->fetchColumn() > 0;
}

function deletePoint($pdo, $point_id) {
    $stmt = $pdo->prepare("DELETE FROM network_points WHERE id = ?");
    return $stmt->execute([$point_id]);
}

function getPointStatusCounts($pdo) {
    $stmt = $pdo->query("
        SELECT status, COUNT(*) as count 
        FROM network_points 
        GROUP BY status
    ");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $counts = [];
    foreach ($result as $row) {
        $counts[$row['status']] = $row['count'];
    }
    return $counts;
}

function filterPoints($pdo, $type = '', $status = '') {
    $sql = "SELECT * FROM network_points WHERE 1=1";
    $params = [];

    if (!empty($type)) {
        $sql .= " AND type = :type";
        $params[':type'] = $type;
    }

    if (!empty($status)) {
        $sql .= " AND status = :status";
        $params[':status'] = $status;
    }

    $sql .= " ORDER BY label";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countAllPoints($pdo, $status, $type) {
    $sql = "SELECT COUNT(*) FROM network_points WHERE 1=1";
        $params = [];

    if (!empty($type)) {
        $sql .= " AND type = :type";
        $params[':type'] = $type;
    }

    if (!empty($status)) {
        $sql .= " AND status = :status";
        $params[':status'] = $status;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return (int)$stmt->fetchColumn();
}


function getPointsWithPagination($pdo, $limit, $offset, $type, $status) {
    $sql = "
        SELECT * FROM network_points WHERE 1=1
    ";

    $params = [];

    if (!empty($type)) {
        $sql .= " AND type = :type";
        $params[':type'] = $type;
    }

    if (!empty($status)) {
        $sql .= " AND status = :status";
        $params[':status'] = $status;
    }

    $sql .= " LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>