--INSERTS COM OBJETOS

	-- INSERE EM EMERGENCIA
	INSERT INTO emergencia 
		(sol.CPF, sol.Nome, sol.RG, sol.Telefone,
	     en.Logradouro, en.Numero, en.Bairro, en.Cidade, en.Estado, 
	     tipo, en.Complemento, Data_Envio, Status, Descricao) 
	VALUES 
		(
			'46045288232','João','42842165', '32035735', 
	     	'Rua Rubens Arruda', '19125', 'Jardim Estoril', 'Bauru', 'SP', 
	     	'Acidente','', NOW(), 0, 'TESTE'
	    );

	-- INSERE EM OCORRÊNCIA
	INSERT INTO ocorrencia
		(
			tipo, sol.Nome, sol.CPF, sol.RG, sol.Telefone,
			en.Logradouro, en.Numero, en.Bairro, en.Cidade, en.Estado, 
			Data_Envio, Status, Descricao
		)
	VALUES
		(
			'Furto', 'Mariana', '46045281870', '41812565', '32365785',
			'Rua Arruda', '19225', 'Jardim Aveiro', 'Bauru', 'SP', 
			NOW(), 0, 'DESCRIÇÃO DA OCORRÊNCIA'
		);

	-- INSERE ADMINISTRADOR 
	INSERT INTO administrativo 
		(
			Registro, Tipo, Senha
		)
	VALUES
		(
			'1234', 'Policia', '123'
		);