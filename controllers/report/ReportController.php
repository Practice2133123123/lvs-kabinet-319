<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/report/ReportModel.php';
require_once __DIR__ . '/../../includes/pagination.php';
require_once __DIR__ . '/../../includes/helpers.php';

$filters = [
    'date_from' => $_GET['date_from'] ?? '',
    'date_to' => $_GET['date_to'] ?? '',
    'section' => $_GET['section'] ?? '',
    'type' => $_GET['type'] ?? '',
    'point_status' => $_GET['point_status'] ?? '',
    'defect_status' => $_GET['defect_status'] ?? ''
];

// Экспорт CSV
if (isset($_GET['export']) && $_GET['export'] == 'csv') {
    $data = getFilteredReportData($pdo, $filters);
    
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="report_' . date('Y-m-d') . '.csv"');
    
    $output = fopen('php://output', 'w');
    
    // Добавляем BOM для UTF-8
    fwrite($output, "\xEF\xBB\xBF");
    
    // Указываем разделитель ';' для Excel
    fputcsv($output, ['ID', 'Материал', 'Количество', 'Дата', 'Комментарий', 'Раздел', 'Точка/Дефект', 'Пользователь', 'Статус точки', 'Статус дефекта'], ';');
    
    foreach ($data as $row) {
        fputcsv($output, [
            $row['id'],
            $row['material_name'],
            $row['quantity'],
            $row['used_at'],
            $row['comment'],
            $row['section'],
            $row['section_name'],
            $row['user_name'],
            $row['point_status'] ?? '-',
            $row['defect_status'] ?? '-'
        ], ';');
    }
    fclose($output);
    exit;
}

$data = getFilteredReportData($pdo, $filters);
$materialTypes = getMaterialTypes($pdo);
$sections = getSections($pdo);
$pointStatuses = getPointStatuses($pdo);
$defectStatuses = getDefectStatuses($pdo);

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// if (!empty($type) || !empty($status)) {
//     $logs = getFilteredReportData($pdo, $filters);
//     $totalPages = 1;
//     $currentPage = 1;
// } else {
    $total = countAllReport($pdo, $filters);
    $pagination = getPaginationInfo($total, $limit, $page);
    
    $data = getReportWithPagination($pdo, $pagination['limit'], $pagination['offset'], $filters);
    $currentPage = $pagination['current_page'];
    $totalPages = $pagination['total_pages'];
// }

include __DIR__ . '/../../views/report/index.php';
?>