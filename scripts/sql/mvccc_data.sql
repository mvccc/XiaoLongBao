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
(4, 'ChineseNewYear2013', '春節聯歡晚會 2013', NULL, '2014-02-28', '4_b.jpg'),
(5, 'MissingAlbum', 'Missing Album', NULL, '2014-03-06', 'missing.jpg');


-- data for table users
INSERT INTO users (username, password, salt, role, first_name) 
values ('admin', 'f51d6b032807c5c85b393cf8a175493afc3facbfec2522ccac91a1bd196431ff', 'efc', 'A', 'ADMIN');
INSERT INTO users (username, password, salt, role, first_name) 
values ('itworker', '9aa2b24fe9dff93f0dc6769eca470f966ab5f46429e312ce1a923f3f87b7d2b7', '359', 'I', 'IT');
INSERT INTO users (username, password, salt, role, first_name) 
values ('editor', '19a6277e0dd005bd37ae60cf053a77f7b99e14e447cb2bd99b908e8955fe2fea', '935', 'E', 'EDITOR');
INSERT INTO users (username, password, salt, role, first_name) 
values ('common_user', '5a79b1f52f10e8c4aeae241761e887813d2bcd4cc1f26756ee8c1a0056731abe', '22a', 'M', 'MEMBER');

-- sunday videos
INSERT INTO videos (title, speaker, date, file_name, audio_name) 
values ('主日信息 (一)', '劉同蘇牧師', '2014-02-01', '2014-02-01.flv', '2014-02-01.mp3');
INSERT INTO videos (title, speaker, date, file_name, audio_name) 
values ('主日信息 (二)', '劉同蘇牧師', '2014-02-02', '2014-02-02.flv', '2014-02-02.mp3');
INSERT INTO videos (title, speaker, date, file_name, audio_name) 
values ('主日信息 (三)', '劉同蘇牧師', '2014-02-03', '2014-02-03.flv', '2014-02-03.mp3');
INSERT INTO videos (title, speaker, date, file_name, audio_name) 
values ('主日信息 (四)', '劉同蘇牧師', '2014-02-04', '2014-02-04.flv', '2014-02-04.mp3');
INSERT INTO videos (title, speaker, date, file_name, audio_name) 
values ('主日信息 (五)', '劉同蘇牧師', '2014-02-05', '2014-02-05.flv', '2014-02-05.mp3');
INSERT INTO videos (title, speaker, date, file_name, audio_name, scripture) 
values ('給我一種新生活', '劉同蘇牧師', '2014-03-02', '2014-03-02.flv', '2014-03-02.mp3',
'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus, felis interdum condimentum consectetur, nisl libero elementum eros, vehicula congue lacus eros non diam. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus mauris lorem, lacinia id tempus non, imperdiet et leo. Cras sit amet erat sit amet lacus egestas placerat. Aenean ultricies ultrices mauris ac congue. In vel tortor vel velit tristique tempus ac id nisi. Proin quis lorem velit. Nunc dui dui, blandit a ullamcorper vitae, congue fringilla lectus. Aliquam ultricies malesuada feugiat. Vestibulum placerat turpis et eros lobortis vel semper sapien pulvinar. Pellentesque rhoncus aliquet porta. Sed vel magna eu turpis pharetra consequat ut vitae lectus. In molestie sollicitudin mi sit amet convallis. Aliquam erat volutpat. Nullam feugiat placerat ipsum eget malesuada. Nulla facilisis nunc non dolor vehicula pretium. Sed dui magna, sodales id pharetra non, ullamcorper eu sapien. Mauris ac consectetur leo. Mauris consequat, lectus ut bibendum pulvinar, leo magna feugiat enim, eu commodo lacus sem vel ante. Sed tempus metus eget leo mollis vulputate. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.');


-- prayers

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
