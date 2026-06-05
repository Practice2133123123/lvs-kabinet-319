<?php
function getUserByLogin($pdo, $login) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->execute([$login]);
    return $stmt->fetch();
}


function createUser($pdo, $login, $password, $role = 'operator')
{
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (login, password_hash, role) VALUES (?, ?, ?)");
    return $stmt->execute([$login, $hash, $role]);
}


