<?php
function getAllPoints($pdo) {
    $stmt = $pdo->query("
        SELECT p.*, u.login as created_by_name 
        FROM network_points p
        LEFT JOIN users u ON p.created_by = u.id
        ORDER BY p.label
    ");
    return $stmt->fetchAll();
}

function getPointById($pdo, $id) {
    $stmt = $pdo->prepare("
        SELECT p.*, u.login as created_by_name 
        FROM network_points p
        LEFT JOIN users u ON p.created_by = u.id
        WHERE p.id = :id
    ");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createPoint($pdo, $data, $created_by = null) {
    $sql = "INSERT INTO network_points (label, type, location, status, last_check, created_by) 
            VALUES (:label, :type, :location, :status, :last_check, :created_by)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':label' => $data['label'],
        ':type' => $data['type'],
        ':location' => $data['location'],
        ':status' => $data['status'],
        ':last_check' => $data['last_check'],
        ':created_by' => $created_by ?? $_SESSION['user_id'] ?? null
    ]);
}

function updatePoint($pdo, $id, $data) {
    $stmt = $pdo->prepare("
        UPDATE network_points 
        SET label = :label, type = :type, location = :location, status = :status 
        WHERE id = :id
    ");
    return $stmt->execute([
        ':id' => $id,
        ':label' => $data['label'],
        ':type' => $data['type'],
        ':location' => $data['location'],
        ':status' => $data['status']
    ]);
}

function hasDefects($pdo, $point_id) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM defects WHERE point_id = ?");
    $stmt->execute([$point_id]);
    $count = $stmt->fetchColumn();
    return $count > 0;
}

function deletePoint($pdo, $point_id) {
    $stmt = $pdo->prepare("DELETE FROM network_points WHERE id = ?");
    return $stmt->execute([$point_id]);
}


