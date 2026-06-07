<?php

// Получение GET параметра с типизацией
function getGetParam($name, $type = 'string', $default = null) {
    if (!isset($_GET[$name])) {
        return $default;
    }

    $value = $_GET[$name];

    switch ($type) {
        case 'int':
            return (int)$value;
        case 'string':
            return trim((string)$value);
        case 'date':
            return trim((string)$value);
        default:
            return $value;
    }
}

// Получение POST параметра с типизацией
function getPostParam($name, $type = 'string', $default = null) {
    if (!isset($_POST[$name])) {
        return $default;
    }

    $value = $_POST[$name];

    switch ($type) {
        case 'int':
            return (int)$value;
        case 'string':
            return trim((string)$value);
        default:
            return $value;
    }
}

// Обработка пагинации
function processPagination($currentPage, $total, $limit = 5) {
    $currentPage = getGetParam('page', 'int', 1);
    if ($currentPage < 1) $currentPage = 1;

    $totalPages = ceil($total / $limit);
    if ($currentPage > $totalPages && $totalPages > 0) {
        $currentPage = $totalPages;
    }

    $offset = ($currentPage - 1) * $limit;

    return [
        'page' => $currentPage,
        'limit' => $limit,
        'offset' => $offset,
        'total_pages' => $totalPages,
        'total' => $total
    ];
}
?>
