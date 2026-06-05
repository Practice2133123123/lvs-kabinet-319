<?php
function getUserByLogin($pdo, $login) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->execute([$login]);
    return $stmt->fetch();
}

function createUser($pdo, $login, $password, $role = 'operator') {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (login, password_hash, role, created_at) VALUES (?, ?, ?, NOW())");
    return $stmt->execute([$login, $hash, $role]);
}

function getAllUsers($pdo) {
    $stmt = $pdo->query("SELECT id, login, role, created_at FROM users ORDER BY id");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateUserRole($pdo, $user_id, $role) {
    $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
    return $stmt->execute([$role, $user_id]);
}

function deleteUser($pdo, $user_id) {
    // Проверяем, не последний ли админ
    $stmt = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'admin'");
    $adminCount = $stmt->fetchColumn();
    
    $stmt = $pdo->prepare("SELECT role FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
    
    if ($user['role'] === 'admin' && $adminCount <= 1) {
        return false; // Нельзя удалить последнего админа
    }
    
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    return $stmt->execute([$user_id]);
}

function getUserById($pdo, $user_id) {
    $stmt = $pdo->prepare("SELECT id, login, role FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetch();
}
?>