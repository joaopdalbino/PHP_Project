DROP DATABASE IF EXISTS BO;
CREATE DATABASE IF NOT EXISTS BO CHARACTER SET utf8 COLLATE utf8_general_ci;
USE BO;

CREATE TABLE endereco (
	Cod_Endereco int NOT NULL AUTO_INCREMENT,
    Logradouro varchar(144),
	Numero int,
	Bairro varchar(144),
	Cidade varchar(144),
	Estado varchar(144),
	Complemento varchar(144),
	PRIMARY KEY (Cod_Endereco)
);

CREATE TABLE solicitante (
	Nome varchar(144),
	RG varchar(9) NOT NULL,
	CPF varchar(11) NOT NULL,
	PRIMARY KEY (CPF)
);

CREATE TABLE administrativo (
	Registro int NOT NULL,
	Tipo int,
	Senha varchar(30),
	PRIMARY KEY (Registro)
);

CREATE TABLE emergencia (
	Cod_Emergecia int NOT NULL AUTO_INCREMENT,
	CPF varchar(11) NOT NULL,
	Cod_Endereco int,
	Tipo int,
    Data_Envio date,
	Status_Emergencia int,
	Descricao varchar(20),
	PRIMARY KEY (Cod_Emergecia),
	FOREIGN KEY (Cod_Endereco) REFERENCES endereco(Cod_Endereco),
	FOREIGN KEY (CPF) REFERENCES solicitante(CPF)
);

CREATE TABLE ocorrencia (
	Cod_Ocorrencia int NOT NULL AUTO_INCREMENT,
    CPF varchar(11) NOT NULL,
	Tipo varchar(144),
	Cod_Endereco int NOT NULL,
	Data_Envio date,
	Status_Ocorrencia int,
	Descricao text,
	PRIMARY KEY (Cod_Ocorrencia),
	FOREIGN KEY (Cod_Endereco) REFERENCES endereco(Cod_Endereco),
    FOREIGN KEY (CPF) REFERENCES solicitante(CPF)
);