<?php
function getAllDefects($pdo) {
    $stmt = $pdo->query("
        SELECT d.*, n.label as point_label 
        FROM defects d
        JOIN network_points n ON d.point_id = n.id
        ORDER BY d.created_at DESC
    ");
    return $stmt->fetchAll();
}
