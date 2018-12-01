#SELECIONA USUÁRIOS

	## cria tipo
	CREATE TYPE seleciona_administrativo AS (
	    Tipo Tipo_adm
	);

	## cria função
	CREATE OR REPLACE FUNCTION seleciona_administrativo (usuario varchar, senha varchar) 
	    RETURNS seleciona_administrativo AS 
	$$ 
	SELECT
	    Tipo
	FROM
	    administrativo
	WHERE
	    Registro = usuario AND Senha = senha
	$$ 
	LANGUAGE SQL;

	## EXEMPLO: select da função seleciona_administrativo 
	select * from seleciona_administrativo('adm', '123')

# CRIA ACESSOS USUÁRIOS
	
	INSERT INTO emergencia 
		(sol.CPF, sol.Nome, sol.RG, sol.Telefone,
	     en.Logradouro, en.Numero, en.Bairro, en.Cidade, en.Estado, 
	     tipo, en.Complemento, Data_Envio, Status, Descricao) 
	VALUES 
		('46045291970','João','41812165', '32035785', 
	     'Rua Rubens Arruda', '19125', 'Jardim Estoril', 'Bauru', 'SP', 
	     'Acidente','', NOW(), 0, 'TESTE');

# ALTERAÇÃO EM TYPES
	
	# ADICIONANDO ELEMENTOS
	ALTER TYPE Tipo_Ambulancia ADD VALUE 'Furto';
	ALTER TYPE Tipo_Ambulancia ADD VALUE 'Roubo';
	ALTER TYPE Tipo_Ambulancia ADD VALUE 'Agressão';

	# ADICIONAR A TIPO OCORRÊNCIA
	ALTER TYPE Tipo_Ocorrencia drop VALUE 'Assédio Sexual';
	ALTER TYPE Tipo_Ocorrencia ADD VALUE 'Assédio Moral';

# SELECIONA EMERGENCIA

	CREATE TYPE 