CREATE TYPE Tipo_ADM AS ENUM ('Ambulancia', 'Policia', 'Administrador');

CREATE TYPE Tipo_Ambulancia AS ENUM ('Acidente', 'Ocorrencia', 'Furto', 'Roubo', 'Agressão');

CREATE TYPE Tipo_Ocorrencia AS ENUM ('Furto', 'Roubo', 'Assédio Sexual', 'Assédio Moral');

CREATE TYPE solicitante AS (
  CPF	VARCHAR (11),
  Nome VARCHAR(250),
  RG VARCHAR(10),
  Telefone VARCHAR(13)
);

CREATE TYPE endereco AS (
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
    sol solicitante,
    en endereco,
    Data_Envio DATE,
    Status INT,
    Descricao TEXT
);

CREATE TABLE emergencia (
  Cod_Emergencia SERIAL PRIMARY KEY,
  sol solicitante,
  en endereco,
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