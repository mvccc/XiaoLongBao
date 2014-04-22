-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 05, 2014 at 06:43 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mvccc`
--
CREATE DATABASE IF NOT EXISTS `mvdb1` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `mvdb1`;

-- --------------------------------------------------------

--
-- Sample table for `persons`
--
CREATE TABLE IF NOT EXISTS `persons`
(
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL UNIQUE,
  PRIMARY KEY (id)
);

-- --------------------------------------------------------

--
-- Table for 'users'
-- role could be 'A': admin/su (for internal use), 'I' IT worker, 'E': content editor, 'M': church member.
--
CREATE TABLE IF NOT EXISTS users
(
  id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(64) NOT NULL,
  salt VARCHAR(3) NOT NULL,
  role CHAR(1) NOT NULL DEFAULT 'M',
  first_name VARCHAR(64),
  last_name VARCHAR(64),
  PRIMARY KEY (id)
);


-- --------------------------------------------------------

--
-- Table for videos/sunday messages
--
CREATE TABLE IF NOT EXISTS videos
(
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(200) NOT NULL,
  speaker VARCHAR(64) NOT NULL,
  scripture VARCHAR(65535),
  file_name VARCHAR(64) NOT NULL,
  audio_name VARCHAR(64),
  date DATE NOT NULL,
  sunday_message CHAR(2) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (id)
);

CREATE INDEX video_by_date ON videos (date);

-- --------------------------------------------------------


--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` mediumint(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `content` varchar(5000) COLLATE utf8_bin DEFAULT NULL,
  `category` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `lang` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `title` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `description` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  `date` date DEFAULT NULL,
  `cover_img_name` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event_tag`
--

CREATE TABLE IF NOT EXISTS `event_tag` (
  `id` mediumint(11) NOT NULL AUTO_INCREMENT,
  `event_id` mediumint(11) NOT NULL,
  `tag_id` mediumint(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tag_id` (`tag_id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` mediumint(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_tag`
--
ALTER TABLE `event_tag`
  ADD CONSTRAINT `FK_TAG` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_EVENT` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- --------------------------------------------------------

--
-- Table structure for table `prayer_sections`
--

CREATE TABLE IF NOT EXISTS `prayer_sections` (
  `id` mediumint(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `prayer_items`
--

CREATE TABLE IF NOT EXISTS `prayer_items` (
  `id` mediumint(11) NOT NULL AUTO_INCREMENT,
  `section_id` mediumint(11) NOT NULL,
  `description` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;
ALTER TABLE `prayer_items`
  ADD CONSTRAINT `FK_PRAYER_SECTION` FOREIGN KEY (`section_id`) REFERENCES `prayer_sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
-- --------------------------------------------------------

--
-- Table structure for table `prayer`
--

CREATE TABLE IF NOT EXISTS `prayer` (
  `date` date NOT NULL,
  `ordinal` smallint(4) NOT NULL,
  `item_id` mediumint(11) NOT NULL,
  PRIMARY KEY (`date`, `item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;
ALTER TABLE `prayer`
  ADD CONSTRAINT `FK_PRAYER_ITEM` FOREIGN KEY (`item_id`) REFERENCES `prayer_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
  
 CREATE TABLE IF NOT EXISTS `prayer_scriptures` (
  `date` date NOT NULL,
  `id` mediumint(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
