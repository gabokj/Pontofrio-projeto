create database sistema_login;
use sistema_login;

create table usuarios (
	id_usuario int auto_increment primary key,
    nome_usuario varchar(150) not null,
    email varchar(150) not null unique,
    senha varchar (200) not null
    ) default charset = utf8mb4;
    