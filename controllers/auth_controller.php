<?php
require_once '../config/db.php';
require_once '../models/UserModel.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($login) && !empty($password)) {
        $user = getUserByLogin($pdo, $login);
        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            header('Location: ../public/index.php');
            exit;
        }
    }
    $error = 'Неверный логин или пароль';
}
