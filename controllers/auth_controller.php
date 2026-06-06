<?php
require_once __DIR__ . '/../config/db.php';
require_once  __DIR__ . '/../models/UserModel.php';
require_once  __DIR__ . '/../models/LogModel.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($login) && !empty($password)) {
        $user = getUserByLogin($pdo, $login);
        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            addLoginLog($pdo, $user['id'], 'LOGIN');
            header('Location: ../public/index.php');
            exit;
        }
    }
    $error = 'Неверный логин или пароль';
}
?>