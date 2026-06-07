<?php
function getAllDefects($pdo, $severity = '', $status = '') {
    $sql = "
        SELECT defects.id, network_points.label AS network_label,
               defects.category, defects.severity, defects.status
        FROM network_points
        JOIN defects ON defects.point_id = network_points.id
        WHERE 1=1
    ";
    $params = [];

    if (!empty($severity)) {
        $sql .= " AND defects.severity = :severity";
        $params[':severity'] = $severity;
    }

    if (!empty($status)) {
        $sql .= " AND defects.status = :status";
        $params[':status'] = $status;
    }

    $sql .= " ORDER BY defects.id DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getDefectById($pdo, $id) {
    $stmt = $pdo->prepare("
        SELECT d.*, np.label as point_label
        FROM defects d
        LEFT JOIN network_points np ON d.point_id = np.id
        WHERE d.id = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getDefectsWithPagination($pdo, $limit, $offset) {
    $stmt = $pdo->prepare("
        SELECT defects.id, network_points.label AS network_label,
               defects.category, defects.severity, defects.status
        FROM network_points
        JOIN defects ON defects.point_id = network_points.id
        ORDER BY defects.id DESC
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countAllDefects($pdo) {
    return $pdo->query("SELECT COUNT(*) FROM defects")->fetchColumn();
}

// Подсчёт дефектов по статусу
function countDefectsByStatus($pdo, $status) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM defects WHERE status = ?");
    $stmt->execute([$status]);
    return $stmt->fetchColumn();
}

// Получить все статусы и их количество
function getDefectStatusCounts($pdo) {
    $stmt = $pdo->query("
        SELECT status, COUNT(*) as count 
        FROM defects 
        GROUP BY status
    ");
    return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
}

// Создать дефект
function createDefect($pdo, $data, $created_by) {
    $stmt = $pdo->prepare("
        INSERT INTO defects (point_id, category, severity, description, status, created_by, created_at)
        VALUES (?, ?, ?, ?, ?, ?, NOW())
    ");
    return $stmt->execute([
        $data['point_id'],
        $data['category'],
        $data['severity'],
        $data['description'],
        $data['status'],
        $created_by
    ]);
}

// Обновить дефект
function updateDefect($pdo, $id, $data) {
    $stmt = $pdo->prepare("
        UPDATE defects 
        SET point_id = ?, category = ?, severity = ?, description = ?, status = ?
        WHERE id = ?
    ");
    return $stmt->execute([
        $data['point_id'],
        $data['category'],
        $data['severity'],
        $data['description'],
        $data['status'],
        $id
    ]);
}

// Удалить дефект
function deleteDefect($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM defects WHERE id = ?");
    return $stmt->execute([$id]);
}

// Проверить, есть ли расходники у дефекта
function hasMaterialUsage($pdo, $defect_id) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM material_usage WHERE defect_id = ?");
    $stmt->execute([$defect_id]);
    return $stmt->fetchColumn() > 0;
}