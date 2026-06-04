<?php
function TypeFilter($pdo){
    $sql = "SELECT * FROM network_points 
     WHERE 1=1";
    $params = [];
        
    if(isset($_GET['type']) && $_GET['type'] !== ''){
        $sql .=" AND type = :type";
        $params['type'] = $_GET['type'];
    }
    if(isset($_GET['status']) && $_GET['status'] !== ''){
        $sql .=" AND status = :status";
        $params['status'] = $_GET['status'];
    }
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}
