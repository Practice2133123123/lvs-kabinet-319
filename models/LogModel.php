<?php
function addLoginLog($pdo, $user_id, $action) {
    $stmt = $pdo->prepare("
        INSERT INTO logs (user_id, action, target_table, created_at) 
        VALUES (?, ?, 'auth', NOW())
    ");
    return $stmt->execute([$user_id, $action]);
}

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
