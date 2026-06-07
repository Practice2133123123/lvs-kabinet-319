<?php
function getTotalPoints($pdo) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM network_points");
    return $stmt->fetchColumn();
}

function getOpenDefects($pdo) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM defects WHERE status = 'open'");
    return $stmt->fetchColumn();
}

function getTotalCable($pdo) {
    $stmt = $pdo->query("SELECT SUM(quantity) FROM material_usage WHERE material_id IN (SELECT id FROM materials WHERE type = 'cable')");
    return $stmt->fetchColumn() ?: 0;
}
?>