CREATE DATABASE IF NOT EXISTS symfony_master;
USE symfony_master;

CREATE TABLE IF NOT EXISTS users(
id      int(255) auto_increment not null,
role        varchar(50), 
name        varchar(100),    
surname     varchar(200),
email       varchar(255),
password    varchar(255),
created_at  datetime, 
CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb; 

INSERT INTO users VALUES(NULL, 'ROLE_USER', 'Mia', 'K', 'random@email.com', 'password', CURTIME());
INSERT INTO users VALUES(NULL, 'ROLE_USER', 'Gia', 'Gunn', 'girl@email.com', 'password', CURTIME());
INSERT INTO users VALUES(NULL, 'ROLE_USER', 'Pia', 'Paredes', 'bobby@email.com', 'password', CURTIME());

CREATE TABLE IF NOT EXISTS tasks(
id              int(255) auto_increment not null;
user_id         int(255) not null,
title           varchar(100),    
content         text,
priority        varchar(20),
hours           int(100),
created_at      datetime, 
CONSTRAINT pk_tasks PRIMARY KEY(id),
CONSTRAINT fk_task_user FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb; 

INSERT INTO tasks VALUES(NULL, 1, 'Task 1', 'test content', 'high', 40, CURTIME());
INSERT INTO tasks VALUES(NULL, 2, 'Task 2', 'test content 2', 'medium', 20, CURTIME());
INSERT INTO tasks VALUES(NULL, 3, 'Task 3', 'test content 3', 'low', 10, CURTIME());
