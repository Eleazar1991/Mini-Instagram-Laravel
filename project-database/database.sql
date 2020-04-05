CREATE DATABASE IF NOT EXISTS laravel_master;
USE laravel_master;

CREATE TABLE IF NOT EXISTS users(
    id int(255) NOT NULL AUTO_INCREMENT,
    role varchar(20),
    name varchar(100),
    surname varchar(200),
    nick varchar(100),
    email varchar(255),
    password varchar(255),
    image varchar(255),
    created_at datetime,
    updated_at datetime,
    remember_token varchar(255),
    CONSTRAINT pk_users PRIMARY KEY (id)
)ENGINE=InnoDB;

INSERT INTO users VALUES(NULL,'user','Eleazar','Perez Arencibia','eleazar_perez','eleazar@perez.com','eleazar1234',null,CURTIME(),CURTIME(),null);
INSERT INTO users VALUES(NULL,'user','Juan','Lopez','juan_lopez','juan@lopez.com','juan1234',null,CURTIME(),CURTIME(),null);
INSERT INTO users VALUES(NULL,'user','Manolo','Garcia','manolo_garcia','manolo@garcia.com','manolo1234',null,CURTIME(),CURTIME(),null);


CREATE TABLE IF NOT EXISTS images(
    id int(255) NOT NULL AUTO_INCREMENT,
    user_id int(255),
    image_path varchar(255),
    description text,
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_images PRIMARY KEY (id),
    CONSTRAINT fk_images_users FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE=InnoDB;

INSERT INTO images VALUES(null,1,'test.jpg','Descripcion de prueba',CURTIME(),CURTIME());
INSERT INTO images VALUES(null,1,'test1.jpg','Descripcion1 de prueba1',CURTIME(),CURTIME());
INSERT INTO images VALUES(null,1,'test2.jpg','Descripcion2 de prueba2',CURTIME(),CURTIME());
INSERT INTO images VALUES(null,3,'test4.jpg','Descripcion4 de prueba4',CURTIME(),CURTIME());

CREATE TABLE IF NOT EXISTS comments(
    id int(255) NOT NULL AUTO_INCREMENT,
    user_id int(255),
    image_id int(255),
    content text,
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_comments PRIMARY KEY (id),
    CONSTRAINT fk_comments_users FOREIGN KEY (user_id) REFERENCES users(id)
    CONSTRAINT fk_comments_images FOREIGN KEY (image_id) REFERENCES images(id)
)ENGINE=InnoDB;

INSERT INTO comments VALUES (null,1,4,'Buena foto de test4',CURTIME(),CURTIME());
INSERT INTO comments VALUES (null,2,1,'Buena foto de test',CURTIME(),CURTIME());
INSERT INTO comments VALUES (null,2,4,'Buena foto de test4 de otro user',CURTIME(),CURTIME());

CREATE TABLE IF NOT EXISTS likes(
    id int(255) NOT NULL AUTO_INCREMENT,
    user_id int(255),
    image_id int(255),
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_likes PRIMARY KEY (id),
    CONSTRAINT fk_likes_users FOREIGN KEY (user_id) REFERENCES users(id)
    CONSTRAINT fk_likes_images FOREIGN KEY (image_id) REFERENCES images(id)
)ENGINE=InnoDB;

INSERT INTO likes VALUES (null,1,4,CURTIME(),CURTIME());
INSERT INTO likes VALUES (null,2,4,CURTIME(),CURTIME());
INSERT INTO likes VALUES (null,3,1,CURTIME(),CURTIME());
INSERT INTO likes VALUES (null,3,2,CURTIME(),CURTIME());
INSERT INTO likes VALUES (null,2,1,CURTIME(),CURTIME());