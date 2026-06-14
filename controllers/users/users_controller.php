<?php
require_once __DIR__ . '/../../models/auth/UserModel.php';
require_once __DIR__ . '/../../models/logs/LogModel.php';
require_once __DIR__ . '/../../includes/pagination.php';
require_once __DIR__ . '/../../includes/helpers.php';

$error = '';
$success = '';
$users = getAllUsers($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    validateCsrfToken();

    if (isset($_POST['update_role'])) {
        $user_id = getPostParam('user_id', 'int');
        $role = getPostParam('role', 'string');

        if (updateUserRole($pdo, $user_id, $role)) {
            $success = 'Роль пользователя обновлена';
            addLog($pdo, $_SESSION['user_id'], 'UPDATE_ROLE', 'users', $user_id);
            $users = getAllUsers($pdo);
        } else {
            $error = 'Ошибка при обновлении роли';
        }
    }

    if (isset($_POST['delete_user'])) {
        $user_id = getPostParam('user_id', 'int');

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
$page = getGetParam('page', 'int', 1);


    $total = countUsers($pdo);
    $pagination = getPaginationInfo($total, $limit, $page);
    
    $users = getUsersWithPagination($pdo, $pagination['limit'], $pagination['offset']);
    $currentPage = $pagination['current_page'];
    $totalPages = $pagination['total_pages'];

?>