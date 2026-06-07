<?php
require_once '../includes/auth.php';
// Главная страница - перенаправляет на dashboard или login
require_once '../config/db.php';

session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard/index.php');
} else {
    header('Location: auth/login.php');
}
exit;
?>
