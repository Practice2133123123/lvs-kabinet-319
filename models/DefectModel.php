<?php
function getAllDefects($pdo) {
    $stmt = $pdo->query("
        SELECT defects.id, network_points.label AS network_label,
               defects.category, defects.severity, defects.status
        FROM network_points
        JOIN defects ON defects.point_id = network_points.id
        ORDER BY defects.id DESC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
>>>>>>> develop
