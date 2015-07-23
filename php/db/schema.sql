DROP DATABASE IF EXISTS fd;
CREATE DATABASE fd;

GRANT ALL PRIVILEGES ON fd.* TO pc@localhost IDENTIFIED BY 'pc';

USE fd;
CREATE TABLE IF NOT EXISTS user(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(32) NOT NULL UNIQUE,
    passwd VARCHAR(15) NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    INDEX(username)
) engine=InnoDB;

create table if not exists account(
    id INT(16) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    password varchar(32) NOT NULL,
    email varchar(80) NOT NULL UNIQUE,
    first_name varchar(80) NOT NULL,
    last_name varchar(80) NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    INDEX(email)
) engine=InnoDB;