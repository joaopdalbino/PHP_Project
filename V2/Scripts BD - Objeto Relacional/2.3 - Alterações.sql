-- ALTERAÇÃO EM TYPES
	
	-- ADICIONANDO ELEMENTOS EM TIPO DE AMBULANCIA
	ALTER TYPE Tipo_Ambulancia ADD VALUE 'Furto';
	ALTER TYPE Tipo_Ambulancia ADD VALUE 'Roubo';
	ALTER TYPE Tipo_Ambulancia ADD VALUE 'Agressão';

	-- ADICIONAR A TIPO OCORRÊNCIA
	ALTER TYPE Tipo_Ocorrencia drop VALUE 'Assédio Sexual';
	ALTER TYPE Tipo_Ocorrencia ADD VALUE 'Assédio Moral';
