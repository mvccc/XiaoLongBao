-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 05, 2014 at 06:25 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mvdb1`
--
USE `mvdb1`;

--
-- Dumping data for table `event`
--

--
-- Dumping data for table `tag`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, '活動'),
(2, '消息');

--
-- Dumping data for table `Persons`
--

INSERT INTO `persons` (`name`) VALUES ('Amy');
INSERT INTO `persons` (`name`) VALUES ('Bob');
INSERT INTO `persons` (`name`) VALUES ('Cun');

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `name`, `title`, `description`, `date`, `cover_img_name`) VALUES
(1, 'awana', 'awana', NULL, '2014-02-25', '1_b.jpg'),
(2, 'ChineseNewYear2014', '春節聯歡晚會 2014', NULL, '2014-02-26', '2_b.jpg'),
(3, 'Summer2013', '夏令會 2013', NULL, '2014-02-27', '3_b.jpg'),
(4, 'ChineseNewYear2013', '春節聯歡晚會 2013', NULL, '2014-02-28', '4_b.jpg');


-- data for table users
INSERT INTO users (username, password, salt, role, first_name) 
values ('admin', 'f51d6b032807c5c85b393cf8a175493afc3facbfec2522ccac91a1bd196431ff', 'efc', 'S', 'admin');

INSERT INTO `prayer_sections` (`name`) VALUES ('差傳事工');
INSERT INTO `prayer_sections` (`name`) VALUES ('教會本週事奉');
INSERT INTO `prayer_sections` (`name`) VALUES ('教會同工與會友');

INSERT INTO `prayer_items` (`description`) VALUES ('禱告事項A1');
INSERT INTO `prayer_items` (`description`) VALUES ('禱告事項A2');
INSERT INTO `prayer_items` (`description`) VALUES ('禱告事項B1');
INSERT INTO `prayer_items` (`description`) VALUES ('禱告事項B2');
INSERT INTO `prayer_items` (`description`) VALUES ('禱告事項B3');
INSERT INTO `prayer_items` (`description`) VALUES ('禱告事項C1');
INSERT INTO `prayer_items` (`description`) VALUES ('禱告事項C2');

INSERT INTO `prayer` (`date`, `section_id`, `ordinal`, `item_id`) VALUES
('2014-03-05', 1, 1, 1),
('2014-03-05', 1, 2, 2),
('2014-03-05', 2, 1, 3),
('2014-03-05', 2, 2, 4),
('2014-03-05', 3, 1, 5),
('2014-03-12', 1, 1, 1),
('2014-03-12', 1, 2, 2),
('2014-03-12', 3, 2, 5),
('2014-03-12', 2, 2, 4),
('2014-03-12', 2, 1, 3),
('2014-03-12', 3, 1, 6),
('2014-03-12', 2, 3, 7);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
