-- Adminer 4.4.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `prokop` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `prokop`;

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `title` varchar(50) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` char(250) NOT NULL,
  `author` varchar(50) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `articles` (`title`, `id`, `content`, `author`, `picture`, `created_at`) VALUES
('xx',	10,	'xx',	'xx',	'500.jpg',	'2018-05-08 00:50:29'),
('xx',	11,	'xx',	'xx',	'500.jpg',	'2018-05-08 00:50:37'),
('xx',	12,	'xx',	'xx',	'499.jpg',	'2018-05-08 19:10:02'),
('xx',	13,	'xx',	'xx',	'499.jpg',	'2018-05-08 19:10:47'),
('xx',	14,	'xx',	'xx',	'499.jpg',	'2018-05-08 19:11:36'),
('aa',	15,	'aax',	'aa',	'499.jpg',	'2018-05-08 19:52:31'),
('axax',	16,	'axaxa',	'ax',	'499.jpg',	'2018-05-08 20:51:21'),
('aad',	17,	'x',	'a',	'499.jpg',	'2018-05-08 21:02:54');

-- 2018-05-08 21:18:52
