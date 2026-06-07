<?php
function addLog($pdo, $user_id, $action, $target_table, $target_id = null) {
    $stmt = $pdo->prepare("
        INSERT INTO logs (user_id, action, target_table, target_id, created_at) 
        VALUES (?, ?, ?, ?, NOW())
    ");
    return $stmt->execute([$user_id, $action, $target_table, $target_id]);
}

function getAllLogs($pdo, $limit = 100) {
    $stmt = $pdo->prepare("
        SELECT l.*, u.login as user_login 
        FROM logs l
        LEFT JOIN users u ON l.user_id = u.id
        ORDER BY l.created_at DESC
        LIMIT ?
    ");
    $stmt->execute([$limit]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getLogsByUser($pdo, $user_id, $limit = 100) {
    $stmt = $pdo->prepare("
        SELECT l.*, u.login as user_login 
        FROM logs l
        LEFT JOIN users u ON l.user_id = u.id
        WHERE l.user_id = ?
        ORDER BY l.created_at DESC
        LIMIT ?
    ");
    $stmt->execute([$user_id, $limit]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getFilteredLogs($pdo, $user_id = null, $action = '', $date_from = '', $date_to = '') {
    $sql = "
        SELECT l.*, u.login as user_login 
        FROM logs l
        LEFT JOIN users u ON l.user_id = u.id
        WHERE 1=1
    ";
    $params = [];

    if ($user_id) {
        $sql .= " AND l.user_id = :user_id";
        $params[':user_id'] = $user_id;
    }
    if (!empty($action)) {
        $sql .= " AND l.action = :action";
        $params[':action'] = $action;
    }
    if (!empty($date_from)) {
        $sql .= " AND DATE(l.created_at) >= :date_from";
        $params[':date_from'] = $date_from;
    }
    if (!empty($date_to)) {
        $sql .= " AND DATE(l.created_at) <= :date_to";
        $params[':date_to'] = $date_to;
    }

    $sql .= " ORDER BY l.created_at DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>