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

function getFilteredLogs($pdo, $user_id = null, $action = null, $date_from = null, $date_to = null) {
    $sql = "SELECT l.*, u.login as user_login 
            FROM logs l 
            LEFT JOIN users u ON l.user_id = u.id 
            WHERE 1=1";
    $params = [];

    if ($user_id) {
        $sql .= " AND l.user_id = :user_id";
        $params[':user_id'] = $user_id;
    }
    if ($action) {
        $sql .= " AND l.action = :action";
        $params[':action'] = $action;
    }
    if ($date_from) {
        $sql .= " AND DATE(l.created_at) >= :date_from";
        $params[':date_from'] = $date_from;
    }
    if ($date_to) {
        $sql .= " AND DATE(l.created_at) <= :date_to";
        $params[':date_to'] = $date_to;
    }

    $sql .= " ORDER BY l.created_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countAllLogs($pdo, $user, $action, $date_from, $date_to) {
    $sql = "SELECT COUNT(*)         FROM logs l
        LEFT JOIN users u ON l.user_id = u.id
        WHERE 1=1";
    $params = [];

    if ($user) {
        $sql .= " AND l.user_id = :user_id";
        $params[':user_id'] = $user;
    }
    if ($action) {
        $sql .= " AND l.action = :action";
        $params[':action'] = $action;
    }
    if ($date_from) {
        $sql .= " AND DATE(l.created_at) >= :date_from";
        $params[':date_from'] = $date_from;
    }
    if ($date_to) {
        $sql .= " AND DATE(l.created_at) <= :date_to";
        $params[':date_to'] = $date_to;
    }

        $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchColumn();
}

function getlogsWithPagination($pdo, $limit, $offset, $user, $action, $date_from, $date_to) {
    $sql = "
        SELECT l.*, u.login as user_login 
        FROM logs l
        LEFT JOIN users u ON l.user_id = u.id
        WHERE 1=1
    ";

        $params = [];

    if ($user) {
        $sql .= " AND l.user_id = :user_id";
        $params[':user_id'] = $user;
    }
    if ($action) {
        $sql .= " AND l.action = :action";
        $params[':action'] = $action;
    }
    if ($date_from) {
        $sql .= " AND DATE(l.created_at) >= :date_from";
        $params[':date_from'] = $date_from;
    }
    if ($date_to) {
        $sql .= " AND DATE(l.created_at) <= :date_to";
        $params[':date_to'] = $date_to;
    }

    $sql .= " LIMIT :limit OFFSET :offset";

    $stmt = $pdo->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}