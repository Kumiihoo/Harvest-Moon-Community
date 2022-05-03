CREATE DATABASE harvestmoon;
USE harvestmoon;

CREATE TABLE users(
id              int(255) auto_increment not null,
username        varchar(100) not null,
email           varchar(255) not null,
password        varchar(255) not null,
role            varchar(20),
avatar          varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email),
CONSTRAINT uq_username UNIQUE(username)  
)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'Admin', 'admin@admin.com', '$2y$04$qcEAcK8mA96mShZxsUPm6.T5i4UhkIkNWS2/GSv9vg5q277jqdq6.', 'admin', null);

CREATE TABLE categories(
id              int(255) auto_increment not null,
category_name   varchar(100) not null,
CONSTRAINT pk_categories PRIMARY KEY(id),
CONSTRAINT uq_category_name UNIQUE(category_name)
)ENGINE=InnoDb;

INSERT INTO categories VALUES(null, 'Noticias');
INSERT INTO categories VALUES(null, 'Guías');
INSERT INTO categories VALUES(null, 'Foro');
INSERT INTO categories VALUES(null, 'Tienda');

CREATE TABLE posts(
id              int(255) auto_increment not null,
category_id     int(255) not null,
author          int(255) not null,
title           varchar(100) not null,
content         text,
date            date not null,
picture         varchar(255),
CONSTRAINT pk_categories PRIMARY KEY(id),
CONSTRAINT fk_post_category FOREIGN KEY(category_id) REFERENCES categories(id),
CONSTRAINT fk_post_user FOREIGN KEY(author) REFERENCES users(id)
)ENGINE=InnoDb;

