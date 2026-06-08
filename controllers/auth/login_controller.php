<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/auth/UserModel.php';
require_once __DIR__ . '/../../includes/helpers.php';

session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = getPostParam('login', 'string');
    $password = getPostParam('password', 'string');

    if (!empty($login) && !empty($password)) {
        $user = getUserByLogin($pdo, $login);
        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            header('Location: ../../public/dashboard/index.php');
            exit;
        }
    }
    $error = 'Неверный логин или пароль';
}

