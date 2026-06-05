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

function getPointsWithPagination($pdo, $limit, $offset) {
    $stmt = $pdo->prepare("SELECT * FROM network_points ORDER BY label LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function countAllPoints($pdo) {
    return $pdo->query("SELECT COUNT(*) FROM network_points")->fetchColumn();
}
?>