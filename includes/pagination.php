<?php

// Функция для получения параметров пагинации
function getPaginationParams($limit = 5) {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    return [
        'page' => $page,
        'limit' => $limit,
        'offset' => ($page - 1) * $limit
    ];
}

// Функция для расчёта итоговой информации пагинации
function getPaginationInfo($total, $limit = 5, $page = 1) {
    $totalPages = ceil($total / $limit);
    if ($page > $totalPages && $totalPages > 0) {
        $page = $totalPages;
    }

    return [
        'current_page' => $page,
        'total_pages' => $totalPages,
        'total' => $total,
        'limit' => $limit,
        'offset' => ($page - 1) * $limit
    ];
}
?>
