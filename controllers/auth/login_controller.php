<?php
require_once __DIR__ . '/../config/db.php';
require_once  __DIR__ . '/../models/UserModel.php';
require_once  __DIR__ . '/../models/LogModel.php';
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/auth/UserModel.php';
require_once __DIR__ . '/../../includes/helpers.php';
// >>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0:controllers/auth/login_controller.php

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
// <<<<<<< HEAD:controllers/auth_controller.php
            addLoginLog($pdo, $user['id'], 'LOGIN');
            header('Location: ../public/index.php');
// =======
            header('Location: ../../public/dashboard/index.php');
// >>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0:controllers/auth/login_controller.php
            exit;
        }
    }
    $error = 'Неверный логин или пароль';
}
// <<<<<<< HEAD:controllers/auth_controller.php
?>
<!-- ======= -->

<!-- >>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0:controllers/auth/login_controller.php -->
