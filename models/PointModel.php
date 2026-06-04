<?php
function getAllPoints($pdo) {
    $stmt = $pdo->query("SELECT * FROM network_points ORDER BY label");
    return $stmt->fetchAll();
}

function updatePoints($pdo, $id, $label, $type, $location, $status, $last_check) {
    $stmt = $pdo->prepare("UPDATE usestatuss SET label = :label, type = :type, location = :location, status = :status, last_check = :last_check WHERE id = :id");
    return $stmt->execute([
        'id' => $id,
        'label' => $label,
        'type' => $type,
        'location' => $location,
        'status' => $status,
        'last_check' => $last_check
    ]);
}
