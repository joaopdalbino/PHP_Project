
-- SELECIONA OCORRÊNCIAS POR CPF E LOCALIZAÇÃO
	SELECT Cod_Ocorrencia FROM ocorrencia WHERE (sol).CPF = '46045281854' AND (en).Logradouro = 'Rua Rubens Mondriam'


-- SELECIONAR TODAS INFORMAÇÕES DE OCORRÊNCIA

	-- Para selecionar as informações no agora Orientado à Objeto, particionamos a consulta em duas
	SELECT * FROM ocorrencia WHERE ocorrencia.Cod_Ocorrencia = 3
	SELECT (en).* FROM ocorrencia WHERE ocorrencia.Cod_Ocorrencia = 3
	SELECT (sol).* FROM ocorrencia WHERE ocorrencia.Cod_Ocorrencia = 3

	-- Na primeira consulta, se realizássemos a somente com o * from ocorrência, o resultado viria somente com uma string de endereço e solicitante.
	-- Por tanto, fizemos as outras duas consultas 

-- SELECIONA USUÁRIOS
	-- Criamos uma função exemplo para selecionar dados dos administradores
	-- cria tipo
	CREATE TYPE seleciona_administrativo AS (
	    Tipo Tipo_adm
	);

	-- cria função
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

	-- EXEMPLO: select da função seleciona_administrativo 
	select * from seleciona_administrativo('adm', '123')