CREATE USER 'bklib'@'localhost' IDENTIFIED BY '***';
CREATE DATABASE bklib CHARACTER SET utf8 COLLATE utf8_general_ci;
GRANT ALL ON bklib.* TO 'bklib'@'localhost';
