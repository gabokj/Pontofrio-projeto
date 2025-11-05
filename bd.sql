create database sistema_login;
use sistema_login;

create table usuarios (
	id_usuario int auto_increment primary key,
    nome_usuario varchar(150) not null,
    email varchar(150) not null unique,
    senha varchar (200) not null
    ) default charset = utf8mb4;
    
CREATE TABLE funcionario (
    id_func INT AUTO_INCREMENT PRIMARY KEY,
    nome_func VARCHAR(150) NOT NULL,
    email_func VARCHAR(150) NOT NULL UNIQUE,
    data_nasc DATE NOT NULL,
    cpf VARCHAR(15) NOT NULL UNIQUE,
    senha_func VARCHAR(150) NOT NULL,
    cargo_func ENUM('Vendedor', 'Gerente', 'Supervisor', 'Analista', 'Assistente', 'Coordenador', 'Diretor') NOT NULL,
    salario_func DECIMAL(10,2) NOT NULL
) DEFAULT CHARSET = utf8mb4;
