<?php
require_once __DIR__ . '/../../models/auth/UserModel.php';
require_once __DIR__ . '/../../models/logs/LogModel.php';
require_once __DIR__ . '/../../includes/pagination.php';

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

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$type = $_GET['type'] ?? '';
$status = $_GET['status'] ?? '';

if (!empty($type) || !empty($status)) {
    $totalPages = 1;
    $currentPage = 1;
} else {
    $total = countUsers($pdo);
    $pagination = getPaginationInfo($total, $limit, $page);
    
    $points = getUsersWithPagination($pdo, $pagination['limit'], $pagination['offset']);
    $currentPage = $pagination['current_page'];
    $totalPages = $pagination['total_pages'];
}
?>