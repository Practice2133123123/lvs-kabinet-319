<?php
function PaginationInventory($pdo){
$items_per_page = 5; 
if (isset($_GET['page'])) {
    $current_page = (int)$_GET['page']; 
} else {
    $current_page = 1; 
}

if ($current_page < 1) {
    $current_page = 1;
}
$total_items = $pdo->query("SELECT COUNT(*) FROM network_points")->fetchColumn();
$total_pages = ceil($total_items / $items_per_page);
if ($current_page > $total_pages && $total_pages > 0) {
    $current_page = $total_pages;
}
$offset = ($current_page - 1) * $items_per_page;
$stmt = $pdo->prepare("SELECT * FROM network_points LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $items_per_page, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$networkPoints = $stmt->fetchAll(PDO::FETCH_ASSOC);
return [
    'items' => $networkPoints,
    'total_pages' => $total_pages,
    'current_page' => $current_page
];
}

function Paginationdefects($pdo){
$items_per_page = 5; 
if (isset($_GET['page'])) {
    $current_page = (int)$_GET['page']; 
} else {
    $current_page = 1; 
}

if ($current_page < 1) {
    $current_page = 1;
}
$total_items = $pdo->query("SELECT COUNT(*) FROM defects")->fetchColumn();
$total_pages = ceil($total_items / $items_per_page);
if ($current_page > $total_pages && $total_pages > 0) {
    $current_page = $total_pages;
}
$offset = ($current_page - 1) * $items_per_page;
$stmt = $pdo->prepare("SELECT defects.id, network_points.label AS network_label,
               defects.category, defects.severity, defects.status
        FROM network_points
        JOIN defects ON defects.point_id = network_points.id
        ORDER BY defects.id DESC
         LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $items_per_page, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$defects = $stmt->fetchAll(PDO::FETCH_ASSOC);
return [
    'items' => $defects,
    'total_pages' => $total_pages,
    'current_page' => $current_page
];
}

function Paginationmaterials($pdo){
$items_per_page = 5; 
if (isset($_GET['page'])) {
    $current_page = (int)$_GET['page']; 
} else {
    $current_page = 1; 
}

if ($current_page < 1) {
    $current_page = 1;
}
$total_items = $pdo->query("SELECT COUNT(*) FROM materials")->fetchColumn();
$total_pages = ceil($total_items / $items_per_page);
if ($current_page > $total_pages && $total_pages > 0) {
    $current_page = $total_pages;
}
$offset = ($current_page - 1) * $items_per_page;
$stmt = $pdo->prepare("SELECT 
            material_usage.id,
            material_usage.quantity,
            material_usage.point_id,
            material_usage.defect_id,
            material_usage.used_by,
            material_usage.used_at,
            material_usage.comment,
            materials.name AS material_name,
            users.login AS user_name,
            network_points.label AS point_label
        FROM material_usage
        LEFT JOIN materials ON material_usage.material_id = materials.id
        LEFT JOIN users ON material_usage.used_by = users.id
        LEFT JOIN network_points ON material_usage.point_id = network_points.id
        ORDER BY material_usage.used_at DESC
         LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $items_per_page, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$materials = $stmt->fetchAll(PDO::FETCH_ASSOC);
return [
    'items' => $materials,
    'total_pages' => $total_pages,
    'current_page' => $current_page
];
}
?>