<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/auth/UserModel.php';
require_once __DIR__ . '/../../includes/helpers.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
<<<<<<< HEAD:public/register.php

include __DIR__ . '/../views/auth/register.php';
=======
>>>>>>> a28f4b63bf104c8e4efbd284294f809a526dc7f0:controllers/auth/register_controller.php
?>