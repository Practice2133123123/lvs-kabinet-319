<?php
define('ROOT_PATH', realpath(__DIR__ . '/..'));
$host = getenv('DB_HOST') ?: 'localhost';
$dbname = getenv('DB_NAME') ?: 'lvs_kabinet_319b';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '1234';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
} catch (PDOException $e) {
    error_log("DB connection error: " . $e->getMessage());
    die("Ошибка подключения к базе данных");
}
?>
