<?php
require_once __DIR__ . '/../../models/auth/UserModel.php';
require_once __DIR__ . '/../../models/logs/LogModel.php';

$error = '';
$success = '';
$users = getAllUsers($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_role'])) {
        $user_id = (int)$_POST['user_id'];
        $role = $_POST['role'];

        if (updateUserRole($pdo, $user_id, $role)) {
            $success = 'Роль пользователя обновлена';
            addLog($pdo, $_SESSION['user_id'], 'UPDATE_ROLE', 'users', $user_id);
            $users = getAllUsers($pdo);
        } else {
            $error = 'Ошибка при обновлении роли';
        }
    }

    if (isset($_POST['delete_user'])) {
        $user_id = (int)$_POST['user_id'];

        if ($user_id == $_SESSION['user_id']) {
            $error = 'Нельзя удалить самого себя';
        } elseif (deleteUser($pdo, $user_id)) {
            $success = 'Пользователь удалён';
            addLog($pdo, $_SESSION['user_id'], 'DELETE', 'users', $user_id);
            $users = getAllUsers($pdo);
        } else {
            $error = 'Нельзя удалить последнего администратора';
        }
    }
}
?>