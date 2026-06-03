<?php
//Вывод всех данных из таблицы network_points
function getNetworkPoints($pdo) {
$stmt = $pdo ->query("SELECT * FROM `network_points` ORDER BY last_check DESC ");
return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}