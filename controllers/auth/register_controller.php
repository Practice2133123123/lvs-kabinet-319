<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/auth/UserModel.php';
require_once __DIR__ . '/../../includes/helpers.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    validateCsrfToken();
    $login = getPostParam('login', 'string');
    $password = getPostParam('password', 'string');
    $confirm = getPostParam('confirm_password', 'string');

    if (empty($login) || empty($password)) {
        $error = 'Заполните все поля';
    } elseif ($password !== $confirm) {
        $error = 'Пароли не совпадают';
    } elseif (strlen($password) < 4) {
        $error = 'Пароль должен быть не менее 4 символов';
    } else {
        $existing = getUserByLogin($pdo, $login);
        if ($existing) {
            $error = 'Пользователь с таким логином уже существует';
        } else {
            if (createUser($pdo, $login, $password)) {
                $success = 'Регистрация успешна! Теперь можно войти.';
            } else {
                $error = 'Ошибка при регистрации';
            }
        }
    }
}
