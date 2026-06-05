<?php
require_once '../config/db.php';
require_once '../models/FilterModel.php';

$filters = [
    'date_from' => $_GET['date_from'] ?? '',
    'date_to' => $_GET['date_to'] ?? '',
    'material_type' => $_GET['material_type'] ?? '',
    'status' => $_GET['status'] ?? '',
    'section' => $_GET['section'] ?? ''
];

// Экспорт CSV
if (isset($_GET['export']) && $_GET['export'] == 'csv') {
    $data = getFilteredData($pdo, $filters);
    
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="report_' . date('Y-m-d') . '.csv"');
    
    $output = fopen('php://output', 'w');
    fputcsv($output, ['ID', 'Материал', 'Количество', 'Дата', 'Комментарий', 'Точка', 'Дефект', 'Пользователь', 'Статус']);
    
    foreach ($data as $row) {
        fputcsv($output, [
            $row['id'],
            $row['material_name'],
            $row['quantity'],
            $row['used_at'],
            $row['comment'],
            $row['point_label'],
            $row['defect_description'],
            $row['user_name'],
            $row['status']
        ]);
    }
    fclose($output);
    exit;
}

$data = getFilteredData($pdo, $filters);
$materialTypes = getMaterialTypes($pdo);
$statuses = getStatuses($pdo);
$sections = getSections($pdo);

include '../views/report/index.php';
