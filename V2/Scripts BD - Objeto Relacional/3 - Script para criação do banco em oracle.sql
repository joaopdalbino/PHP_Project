CREATE TYPE Solicitante_objtyp AS OBJECT (
  CPF VARCHAR2(11),
  Nome VARCHAR2(250),
  RG VARCHAR2(10),
  Telefone VARCHAR2(13)
);

CREATE TYPE Endereco_objtyp AS OBJECT (
    Cod INT,
    Logradouro VARCHAR2(250),
    Numero INT,
    Bairro VARCHAR2(250),
    Cidade VARCHAR2(250),
    Estado CHAR(2),
    Complemento VARCHAR2(250)
);
CREATE TYPE Ocorrencia_objtyp AS OBJECT (
    Cod INT,
    Solicitante_ref REF Solicitante_objtyp,
    Tipo INT, 
    Endereco_ref REF Endereco_objtyp,
    Data_Envio DATE,
    Status INT,
    Descricao VARCHAR2(1000)
);
CREATE TYPE Emergencia_objtyp AS OBJECT (
  Cod INT,
  Solicitante_ref REF Solicitante_objtyp,
  Endereco_ref REF Endereco_objtyp,
  Tipo INT,
  Data_Envio DATE,
  Status INT,
  Descricao VARCHAR2(1000)
);
CREATE TYPE Administrativo_objtyp AS OBJECT (
  Registro VARCHAR2(50),
  Tipo INT,
  Senha VARCHAR2(30)
);

CREATE TABLE Solicitante_objtab OF Solicitante_objtyp (CPF PRIMARY KEY) 
   OBJECT IDENTIFIER IS PRIMARY KEY;

CREATE TABLE Endereco_objtab OF Endereco_objtyp (Cod PRIMARY KEY) 
   OBJECT IDENTIFIER IS PRIMARY KEY;

CREATE TABLE Ocorrencia_objtab OF Ocorrencia_objtyp (Cod PRIMARY KEY) 
   OBJECT IDENTIFIER IS PRIMARY KEY;

CREATE TABLE Emergencia_objtab OF Emergencia_objtyp (Cod PRIMARY KEY) 
   OBJECT IDENTIFIER IS PRIMARY KEY;

CREATE TABLE Administrativo_objtab OF Administrativo_objtyp (Registro PRIMARY KEY) 
   OBJECT IDENTIFIER IS PRIMARY KEY;