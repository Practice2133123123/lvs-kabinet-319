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

<<<<<<< HEAD
function createPoint($pdo, $data) {
=======
function createPoint($pdo, $data)
{
>>>>>>> dc38333d443785fcc3bba21a74c498e51dd4f5fa
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
<<<<<<< HEAD
        SET label = :label, 
            type = :type, 
            location = :location, 
            status = :status, 
            last_check = :last_check
=======
        SET label = :label, type = :type, location = :location, status = :status 
>>>>>>> dc38333d443785fcc3bba21a74c498e51dd4f5fa
        WHERE id = :id
    ");
    return $stmt->execute([
        ':id' => $id,
        ':label' => $data['label'],
        ':type' => $data['type'],
        ':location' => $data['location'],
<<<<<<< HEAD
        ':status' => $data['status'],
        ':last_check' => $data['last_check'] ?? null
    ]);
}

// Проверить, есть ли у точки связанные дефекты
function hasDefects($pdo, $point_id) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM defects WHERE point_id = ?");
    $stmt->execute([$point_id]);
    return $stmt->fetchColumn() > 0;
}

// Удалить точку
function deletePoint($pdo, $point_id) {
    $stmt = $pdo->prepare("DELETE FROM network_points WHERE id = ?");
    return $stmt->execute([$point_id]);
}
=======
        ':status' => $data['status']
    ]);
}



>>>>>>> dc38333d443785fcc3bba21a74c498e51dd4f5fa
