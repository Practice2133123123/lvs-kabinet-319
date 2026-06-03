<?php
require_once '../config/db.php';

if (isset($pdo)) {
    echo "PDO существует!";
    var_dump($pdo);
} else {
    echo "PDO не существует";
}
?>