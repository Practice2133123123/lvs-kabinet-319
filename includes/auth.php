<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require_once '../config/db.php';
require_once '../models/UserModel.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

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
?>