<?php
function addMaterial($pdo, $data) {
    $stmt = $pdo->prepare("INSERT INTO material_usage (material_id, quantity, point_id, defect_id, used_by, comment) 
        VALUES (:material_id, :quantity, :point_id, :defect_id, :used_by, :comment)
    "
    );
    return $stmt->execute([
        ':material_id' => $data['material_id'],
        ':quantity' => $data['quantity'],
        ':point_id' => $data['point_id'],
        ':defect_id' => $data['defect_id'],
        ':used_by' => $data['used_by'],
        ':comment' => $data['comment']
    ]);
}

function getAllMaterials($pdo) {
    $stmt = $pdo->query('SELECT * FROM material_usage');
        // SELECT mu.*, m.name as material_name, u.login as user_name 
        // FROM material_usage mu
        // LEFT JOIN materials m ON mu.material_id = m.id
        // LEFT JOIN users u ON mu.used_by = u.id
        // ORDER BY mu.used_at DESC
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getMaterialsList($pdo) {
    $stmt = $pdo->query("SELECT id, name FROM materials ORDER BY name");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUsersList($pdo) {
    $stmt = $pdo->query("SELECT id, login FROM users ORDER BY login");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>