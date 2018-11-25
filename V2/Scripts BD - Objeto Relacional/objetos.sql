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

# CRIA ACESSOS
	
	# CRIA OBJETO
	CREATE TYPE insere_solicitante AS (
	    
	    Tipo Tipo_adm
	);


# ALTERAÇÃO EM TYPES
	
	# ADICIONANDO ELEMENTOS
	ALTER TYPE Tipo_Ambulancia ADD VALUE 'Furto';
	ALTER TYPE Tipo_Ambulancia ADD VALUE 'Roubo';
	ALTER TYPE Tipo_Ambulancia ADD VALUE 'Agressão';

	# ADICIONAR A TIPO OCORRÊNCIA
	ALTER TYPE Tipo_Ocorrencia ADD VALUE 'Assédio Sexual';
	ALTER TYPE Tipo_Ocorrencia ADD VALUE 'Assédio Moral';