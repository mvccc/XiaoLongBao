-- Copyright (C) 2013, 2014 Triassic. All rights reserved.
--
-- Drop database users and database.

-- DROP USER IF EXISTS
-- Read: http://bugs.mysql.com/bug.php?id=19166
-- A good workaround is to grant a harmless privilege to the user before dropping it.  
-- This will create the user if it doesn't exist, so that it can be dropped safely, 
-- like so:
--
-- GRANT USAGE ON *.* TO 'username'@'localhost';
-- DROP USER 'username'@'localhost';

GRANT USAGE ON *.* TO 'xiaolongbao'@'localhost';
DROP USER 'xiaolongbao'@'localhost';

GRANT USAGE ON *.* TO 'xiaolongbao'@'%';
DROP USER 'xiaolongbao'@'%';

GRANT USAGE ON *.* TO 'dba'@'localhost';
DROP USER 'dba'@'localhost';

GRANT USAGE ON *.* TO 'dba'@'%';
DROP USER 'dba'@'%';

DROP DATABASE IF EXISTS `mvdb1`;
