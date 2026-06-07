<?php
// Главная страница - перенаправляет на dashboard или login
require_once '../config/db.php';

session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: ../public/dashboard/index.php');
} else {
    header('Location: ../public/auth/login.php');
}
exit;
?>
