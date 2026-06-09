<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// if (!isset($_SESSION['user_id'])) {
//     header('Location: /public/auth/login.php');
//     exit;
// }

// Проверка авторизации (для действий)
function requireAuth() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /public/auth/login.php');
        exit;
    }
}

// Проверка прав администратора
function requireAdmin() {
    requireAuth();
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
        header('Location: /public/index.php');
        exit;
    }
}

// Проверка, авторизован ли пользователь
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Получить роль текущего пользователя
function getCurrentUserRole() {
    return $_SESSION['user_role'] ?? null;
}

// Проверка на администратора (для views)
function isAdmin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}
?>