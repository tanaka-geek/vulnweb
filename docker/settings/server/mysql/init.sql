CREATE DATABASE IF NOT EXISTS vulnweb;

USE vulnweb; 

CREATE TABLE IF NOT EXISTS users (
  username varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  is_admin BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY  (username)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS profile (
  id int(10) NOT NULL auto_increment,
  username varchar(255) NOT NULL,
  fullname varchar(255) NULL,
  address varchar(255) collate utf8_unicode_ci NULL,
  phone varchar(255) NULL,
  age int(10)  NULL,
  PRIMARY KEY  (id),
  FOREIGN KEY (username)
  REFERENCES users (username)
  ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

INSERT INTO users (username, password, is_admin) VALUES ("admin", "$2y$10$QJoCyvIXqCSFIxHwet0PyuWHgbcywipLxteWEZl7..B3JJ1iafyvm", TRUE);
INSERT INTO profile (username, fullname, address, phone, age) VALUES ('admin','administrator','India, Bandipur','071-1446-2372','89')