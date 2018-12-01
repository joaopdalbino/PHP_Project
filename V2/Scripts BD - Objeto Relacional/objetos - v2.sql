#INSERTS COM OBJETOS

	#INSERE EM EMERGENCIA
	INSERT INTO emergencia 
		(sol.CPF, sol.Nome, sol.RG, sol.Telefone,
	     en.Logradouro, en.Numero, en.Bairro, en.Cidade, en.Estado, 
	     tipo, en.Complemento, Data_Envio, Status, Descricao) 
	VALUES 
		(
			'46045291970','João','41812165', '32035785', 
	     	'Rua Rubens Arruda', '19125', 'Jardim Estoril', 'Bauru', 'SP', 
	     	'Acidente','', NOW(), 0, 'TESTE'
	    );

	#INSERE EM OCORRÊNCIA
	INSERT INTO ocorrencia
		(
			tipo, sol.Nome, sol.CPF, sol.RG, sol.Telefone,
			en.Logradouro, en.Numero, en.Bairro, en.Cidade, en.Estado, 
			Data_Envio, Status, Descricao
		)
	VALUES
		(
			'Furto', 'Mariana', '46045281870', '41812165', '32035785',
			'Rua Rubens Arruda', '19125', 'Jardim Estoril', 'Bauru', 'SP', 
			NOW(), 0, 'DESCRIÇÃO DA OCORRÊNCIA'
		);

# ALTERAÇÃO EM TYPES
	
	# ADICIONANDO ELEMENTOS EM TIPO DE AMBULANCIA
	ALTER TYPE Tipo_Ambulancia ADD VALUE 'Furto';
	ALTER TYPE Tipo_Ambulancia ADD VALUE 'Roubo';
	ALTER TYPE Tipo_Ambulancia ADD VALUE 'Agressão';

	# ADICIONAR A TIPO OCORRÊNCIA
	ALTER TYPE Tipo_Ocorrencia drop VALUE 'Assédio Sexual';
	ALTER TYPE Tipo_Ocorrencia ADD VALUE 'Assédio Moral';

# SELECIONA EMERGENCIA
	
	