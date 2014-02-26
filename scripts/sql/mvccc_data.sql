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
USE `mvdb1`

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
