CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `root` int(10) unsigned NOT NULL,
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  `level` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `slug` varchar(127) NOT NULL,
  `layout` varchar(15) DEFAULT NULL,
  `is_published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `page_title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `root` (`root`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `level` (`level`)
);

INSERT INTO `pages` (`id`, `root`, `lft`, `rgt`, `level`, `parent_id`, `slug`, `layout`, `is_published`, `page_title`, `content`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(1, 1, 1, 6, 1, 0, 'o-kompanii', 'column2', 1, 'О компании', '<p>Текст о компании</p>', 'О компании', '', ''),
(2, 1, 4, 5, 2, 1, 'sotrudniki', NULL, 1, 'Сотрудники', '<p>Список сотрудников</p>', 'Сотрудники', '', ''),
(3, 1, 2, 3, 2, 1, 'karta-proezda', NULL, 1, 'Карта проезда', '<p>Карта проезда</p>', 'Карта проезда', '', ''),
(4, 4, 1, 2, 1, 0, 'yuridicheskaya-informaciya', NULL, 1, 'Юридическая информация', '<p>Юридическая информация<br>\r\n</p>\r\n', 'Юридическая информация', '', ''),
(5, 5, 1, 8, 1, 0, 'uroven-1', NULL, 1, 'Уровень 1', '<p><br></p>\r\n', 'Уровень 1', '', ''),
(6, 5, 2, 7, 2, 5, 'uroven-2', NULL, 1, 'Уровень 2', '<p><br></p>\r\n', 'Уровень 2', '', ''),
(7, 5, 3, 6, 3, 6, 'uroven-3', NULL, 1, 'Уровень 3', '<p><br></p>\r\n', 'Уровень 3', '', ''),
(8, 5, 4, 5, 4, 7, 'uroven-4', NULL, 1, 'Уровень 4', '<p><br></p>', 'Уровень 4', '', ''),
(9, 9, 1, 2, 1, 0, 'neopublikovannaya-stranica', NULL, 0, 'Неопубликованная страница', '<p>Неопубликованная страница\r\n</p>', 'Неопубликованная страница', '', '');
