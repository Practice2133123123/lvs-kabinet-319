<?php
require_once __DIR__ . '/../models/PointModel.php';

require_once __DIR__ . '/../models/FilterModel.php';
if(isset($_GET['type'])){
$points = TypeFilter($pdo);
}
elseif(isset($_GET['status'])){
   $points=StatusFilter($pdo);
}else{

$points = getAllPoints($pdo);
}