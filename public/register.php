<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/UserModel.php';

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
        $stmt = $pdo->prepare("SELECT id FROM users WHERE login = ?");
        $stmt->execute([$login]);
        if ($stmt->fetch()) {
            $error = 'Пользователь с таким логином уже существует';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (login, password_hash, role) VALUES (?, ?, 'operator')");
            if ($stmt->execute([$login, $hash])) {
                $success = 'Регистрация успешна! Теперь можно войти.';
            } else {
                $error = 'Ошибка при регистрации';
            }
        }
    }
}

include __DIR__ . '/../views/auth/register.php';
?>