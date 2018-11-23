CREATE TYPE Tipo_ADM AS ENUM ('Ambulancia', 'Policia', 'Administrador');

CREATE TYPE Tipo_Ambulancia AS ENUM ('Acidente', 'Ocorrencia');

CREATE TYPE Tipo_Ocorrencia AS ENUM ('Furto', 'Roubo', 'Agressão');

CREATE TABLE solicitante(
   	CPF	VARCHAR (11) NOT NULL PRIMARY KEY,
   	Nome VARCHAR(250),
   	RG VARCHAR(10),
   	Telefone VARCHAR(13)
);

CREATE TABLE endereco (
    Cod_Endereco SERIAL PRIMARY KEY,
    Logradouro VARCHAR(250),
    Numero INT,
    Bairro VARCHAR(250),
    Cidade VARCHAR(250),
    Estado CHAR(2),
    Complemento VARCHAR(250)
);

CREATE TABLE ocorrencia (
    Cod_Ocorrencia SERIAL PRIMARY KEY,
    Tipo Tipo_Ocorrencia, 
    CPF VARCHAR REFERENCES solicitante(CPF),
    Cod_Endereco INT REFERENCES endereco(Cod_Endereco),
    Data_Envio DATE,
    Status INT,
    Descricao TEXT
);

CREATE TABLE emergencia (
  Cod_Emergencia SERIAL PRIMARY KEY,
  Cod_Endereco INT REFERENCES endereco(Cod_Endereco),
  CPF VARCHAR REFERENCES solicitante(CPF),
  Tipo Tipo_Ambulancia,
  Data_Envio DATE,
  Status INT,
  Descricao TEXT
);

CREATE TABLE administrativo (
  Registro VARCHAR(50),
  Tipo Tipo_ADM,
  Senha VARCHAR(30)
);