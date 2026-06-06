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

// Проверить, существует ли метка
function isLabelExists($pdo, $label, $exclude_id = null) {
    if ($exclude_id) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM network_points WHERE label = ? AND id != ?");
        $stmt->execute([$label, $exclude_id]);
    } else {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM network_points WHERE label = ?");
        $stmt->execute([$label]);
    }
    return $stmt->fetchColumn() > 0;
}

function createPoint($pdo, $data, $created_by = null) {
    // Проверка на уникальность метки
    if (isLabelExists($pdo, $data['label'])) {
        return false; // Метка уже существует
    }
    
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
    // Проверка на уникальность метки (исключая текущую запись)
    if (isLabelExists($pdo, $data['label'], $id)) {
        return false; // Метка уже существует у другой точки
    }
    
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

// Функция для получения всех точек для выпадающего списка
function getAllPointsForSelect($pdo) {
    $stmt = $pdo->query("SELECT id, label FROM network_points ORDER BY label");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>