USE bklib;

DROP TABLE IF EXISTS catalog;
DROP TABLE IF EXISTS catalogcopy;
DROP TABLE IF EXISTS author;
DROP TABLE IF EXISTS author_catalog;
DROP TABLE IF EXISTS category;
DROP TABLE IF EXISTS location;

CREATE TABLE catalog (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(500) NOT NULL,
    callnumber VARCHAR(50) DEFAULT NULL,
    dewnumber VARCHAR(50) DEFAULT NULL,
    pubyear VARCHAR(4) DEFAULT NULL,
    edition VARCHAR(4) DEFAULT NULL,
    category VARCHAR(100) NOT NULL,
    FOREIGN KEY (category) REFERENCES category(category) ON UPDATE CASCADE,
    INDEX (title)
) ENGINE MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE catalogcopy (
    catalog_id INT NOT NULL,
    location VARCHAR(100) NOT NULL,
    FOREIGN KEY (catalog_id) REFERENCES catalog(id) ON DELETE CASCADE,
    FOREIGN KEY (location) REFERENCES location(location) ON UPDATE CASCADE
) ENGINE MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE author (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100) DEFAULT NULL,
    lastname VARCHAR(100) DEFAULT NULL,
    INDEX (firstname),
    INDEX (lastname),
    INDEX (firstname, lastname)
) ENGINE MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE author_catalog (
    author_id INT NOT NULL,
    catalog_id INT NOT NULL,
    FOREIGN KEY (author_id) REFERENCES author(id) ON DELETE CASCADE,
    FOREIGN KEY (catalog_id) REFERENCES catalog(id) ON DELETE CASCADE,
    UNIQUE INDEX (author_id, catalog_id)
) ENGINE MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE category (
    category VARCHAR(100) PRIMARY KEY,
    description TEXT DEFAULT NULL
) ENGINE MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE location (
    location VARCHAR(100) PRIMARY KEY,
    direction TEXT DEFAULT NULL
) ENGINE MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


