-- Copyright (C) 2013, 2014 Triassic. All rights reserved.
--
-- Create database, database user and setup the user privileges.
--
-- Database user `dba` is used for database maintenance.
--
-- Database user `xiaolongbao` is an application user. MVCCC web application
-- should use this user for the database connection.

-- Create database.
CREATE DATABASE IF NOT EXISTS `mvdb1` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `mvdb1`;

-- Create DBA user.
CREATE USER 'dba'@'localhost' IDENTIFIED BY 'dba!mvdb';
CREATE USER 'dba'@'%' IDENTIFIED BY 'dba!mvdb';

GRANT ALL PRIVILEGES ON mvdb1.* TO 'dba'@'localhost' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON mvdb1.* TO 'dba'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;

-- Create Application user.
CREATE USER 'xiaolongbao'@'localhost' IDENTIFIED BY 'woaichi';
CREATE USER 'xiaolongbao'@'%' IDENTIFIED BY 'woaichi';

GRANT INSERT, SELECT, UPDATE, DELETE ON mvdb1.* TO 'xiaolongbao'@'localhost';
GRANT INSERT, SELECT, UPDATE, DELETE ON mvdb1.* TO 'xiaolongbao'@'%';
FLUSH PRIVILEGES;
