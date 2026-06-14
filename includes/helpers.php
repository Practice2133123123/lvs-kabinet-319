<?php

// CSRF-защита
function generateCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrfField() {
    return '<input type="hidden" name="csrf_token" value="' . generateCsrfToken() . '">';
}

function validateCsrfToken() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
            die('Ошибка безопасности: неверный CSRF-токен');
        }
    }
}

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
function processPagination($total, $limit = 5) {
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
