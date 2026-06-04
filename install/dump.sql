<<<<<<< HEAD
Вот ваш исправленный SQL-скрипт с **ровным форматированием** всех INSERT-запросов:

sql
=======

>>>>>>> develop
CREATE DATABASE IF NOT EXISTS `lvs_kabinet_319b`;
USE `lvs_kabinet_319b`;


CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `login` varchar(50) NOT NULL UNIQUE,
    `password_hash` varchar(255) NOT NULL,
    `role` enum('admin','operator') DEFAULT 'operator',
    PRIMARY KEY (`id`)
);

INSERT INTO `users` (`id`, `login`,           `password_hash`,                                                        `role`) VALUES
(1,                     'admin',             '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',        'admin'),
(2,                     'operator',          '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',        'operator'),
(3,                     'ivanov_adm',        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',        'admin'),
(4,                     'petrov_op',         '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',        'operator'),
(5,                     'sidorov_op',        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',        'operator');


CREATE TABLE `network_points` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `label` varchar(20) NOT NULL UNIQUE,
    `type` enum('socket','switch','cable_run','patch_cord') NOT NULL,
    `location` varchar(100) DEFAULT NULL,
    `status` enum('active','defect','decommissioned') DEFAULT 'active',
    `last_check` date DEFAULT NULL,
    PRIMARY KEY (`id`)
);

INSERT INTO `network_points` (`id`, `label`,        `type`,     `location`,                              `status`,    `last_check`) VALUES
(1,                             'Розетка_1',        'socket',   'Стена левая, отступ 200см',             'active',    '2026-05-15'),
(2,                             'Розетка_2',        'socket',   'Стена левая, отступ 400см',             'active',    '2026-05-15'),
(3,                             'Розетка_3',        'socket',   'Стена левая, отступ 600см',             'defect',    '2026-05-15'),
(4,                             'Розетка_4',        'socket',   'Стена верхняя, центр',                  'defect',    '2026-05-10'),
(5,                             'Розетка_5',        'socket',   'Стена правая, отступ 150см',            'active',    '2026-05-15'),
(6,                             'Розетка_6',        'socket',   'Стена правая, отступ 350см',            'defect',    '2026-05-12'),
(7,                             'Розетка_7',        'socket',   'Стена правая, отступ 550см',            'defect',    '2026-05-15'),
(8,                             'Розетка_8',        'socket',   'Стена нижняя (преподавательская)',      'active',    '2026-05-14');


CREATE TABLE `defects` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `point_id` int(11) NOT NULL,
    `category` varchar(50) DEFAULT NULL,
    `severity` enum('high','medium','low') DEFAULT NULL,
    `description` text,
    `status` enum('open','in_progress','closed') DEFAULT 'open',
    `created_by` int(11) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `point_id` (`point_id`),
    KEY `created_by` (`created_by`),
    CONSTRAINT `defects_ibfk_1` FOREIGN KEY (`point_id`) REFERENCES `network_points` (`id`) ON DELETE CASCADE,
    CONSTRAINT `defects_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
);

INSERT INTO `defects` (`id`, `point_id`, `category`,             `severity`, `description`,                                                           `status`,        `created_by`, `created_at`) VALUES
(1,                    3,           'Обрыв проводника',       'high',      'Обрыв проводника №5. Порт коммутатора 3',                               'open',          1,            '2026-06-02 19:24:57'),
(2,                    4,           'Обрыв проводника',       'high',      'Обрыв проводников №2 и №5. Дефектный патч-корд',                        'in_progress',   2,            '2026-06-02 19:24:57'),
(3,                    5,           'Обрыв проводника',       'medium',    'Обрыв проводников №5 и №8. Порт 6',                                     'open',          1,            '2026-06-02 19:24:57'),
(4,                    6,           'Ошибка кроссировки',     'medium',    'Перекрест проводников №4 и №8 (Cross). Порт 7',                         'open',          3,            '2026-06-02 19:24:57'),
(5,                    7,           'Отсутствие контакта',    'high',      'Полное отсутствие контакта на проводниках №1,№2,№3. Связь с портом 24', 'open',          1,            '2026-06-02 19:24:57'),
(6,                    2,           'Обрыв проводника',       'medium',    'Обрыв проводника №8. Дефект на стороне розетки. Порт 17',               'open',          4,            '2026-06-02 19:24:57'),
(7,                    1,           'Обрыв проводника',       'medium',    'Обрыв проводника №8. Дефект на стороне розетки. Порт 19',               'open',          5,            '2026-06-02 19:24:57'),
(8,                    8,           'Короткое замыкание',     'high',      'Объединение физической трассы с портом 16. Порты 16 и 24',              'closed',        2,            '2026-06-02 19:24:57');


CREATE TABLE `materials` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `type` enum('cable','connector','socket','fastener','other') NOT NULL,
    `unit` enum('m','pcs') NOT NULL,
    PRIMARY KEY (`id`)
);

INSERT INTO `materials` (`id`, `name`,                                          `type`,       `unit`) VALUES
(1,                       'Кабель-канал 40x20 мм',                             'other',      'm'),
(2,                       'Розетка сетевая RJ-45 двухпортовая Cat.5e',        'socket',     'pcs'),
(3,                       'Розетка сетевая RJ-45 однопортовая Cat.5e',        'socket',     'pcs'),
(4,                       'Соединитель кабельный (скотч-лок) для витой пары',  'connector',  'pcs'),
(5,                       'Кабель U/UTP Cat.5e 4 пары',                        'cable',      'm'),
(6,                       'Розетка электрическая 220В двойная',                'other',      'pcs'),
(7,                       'Розетка электрическая 220В одинарная',              'other',      'pcs'),
(8,                       'Кабель силовой электрический ПВС 3x1.5',            'cable',      'm');


CREATE TABLE `material_usage` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `material_id` int(11) NOT NULL,
    `quantity` decimal(10,2) NOT NULL,
    `point_id` int(11) DEFAULT NULL,
    `defect_id` int(11) DEFAULT NULL,
    `used_by` int(11) NOT NULL,
    `used_at` datetime DEFAULT CURRENT_TIMESTAMP,
    `comment` text,
    PRIMARY KEY (`id`),
    KEY `material_id` (`material_id`),
    KEY `point_id` (`point_id`),
    KEY `defect_id` (`defect_id`),
    KEY `used_by` (`used_by`),
    CONSTRAINT `material_usage_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`),
    CONSTRAINT `material_usage_ibfk_2` FOREIGN KEY (`point_id`) REFERENCES `network_points` (`id`) ON DELETE SET NULL,
    CONSTRAINT `material_usage_ibfk_3` FOREIGN KEY (`defect_id`) REFERENCES `defects` (`id`) ON DELETE SET NULL,
    CONSTRAINT `material_usage_ibfk_4` FOREIGN KEY (`used_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
);

INSERT INTO `material_usage` (`id`, `material_id`, `quantity`, `point_id`, `defect_id`, `used_by`, `used_at`,               `comment`) VALUES
(1,                    5,             '12.00',    NULL,       1,          2,         '2026-06-02 22:24:57',   'Замена кабеля на линии порта 3 (обрыв проводника 5)'),
(2,                    5,             '15.00',    NULL,       2,          2,         '2026-06-02 22:24:57',   'Замена дефектного патч-корда на порту 4'),
(3,                    2,             '3.00',     3,          3,          3,         '2026-06-02 22:24:57',   'Замена розетки RJ-45 на порту 6'),
(4,                    4,             '2.00',     NULL,       4,          1,         '2026-06-02 22:24:57',   'Восстановление обрыва на порту 7 через соединитель'),
(5,                    5,             '25.00',    NULL,       5,          2,         '2026-06-02 22:24:57',   'Полная перекладка кабеля порты 16-24'),
(6,                    2,             '1.00',     2,          6,          4,         '2026-06-02 22:24:57',   'Замена розетки на порту 17 (обрыв 8 жилы)'),
(7,                    2,             '1.00',     1,          7,          5,         '2026-06-02 22:24:57',   'Замена розетки на порту 19 (обрыв 8 жилы)'),
(8,                    1,             '25.00',    8,          8,          3,         '2026-06-02 22:24:57',   'Монтаж нового кабель-канала вдоль стен');


CREATE TABLE `logs` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) DEFAULT NULL,
    `action` varchar(100) DEFAULT NULL,
    `target_table` varchar(50) DEFAULT NULL,
    `target_id` int(11) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `user_id` (`user_id`),
    CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
);

INSERT INTO `logs` (`id`, `user_id`, `action`,      `target_table`,    `target_id`, `created_at`) VALUES
(1,                    1,           'CREATE',      'defects',         1,           '2026-06-02 19:24:57'),
(2,                    2,           'UPDATE',      'defects',         2,           '2026-06-02 19:24:57'),
(3,                    3,           'DELETE',      'material_usage',  3,           '2026-06-02 19:24:57'),
(4,                    1,           'INSERT',      'network_points',  8,           '2026-06-02 19:24:57'),
(5,                    2,           'UPDATE',      'materials',       5,           '2026-06-02 19:24:57'),
(6,                    4,           'CREATE',      'defects',         8,           '2026-06-02 19:24:57'),
(7,                    5,           'DELETE',      'network_points',  6,           '2026-06-02 19:24:57'),
(8,                    3,           'INSERT',      'material_usage',  4,           '2026-06-02 19:24:57');
