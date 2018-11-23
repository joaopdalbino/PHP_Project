<?php

	function Insere_BO($tipo, $logradouro, $numero, $bairro, $complemento, $cidade, $estado, $descricao, $nome, $rg, $cpf, $telefone){
		include "db.php";
		Checa_Solicitante($cpf, $nome, $rg, $telefone);
		$id_endereco = Insere_Endereco($logradouro, $numero, $bairro, $complemento, $cidade, $estado);
		$data_envio = date("Y-m-d H:i:s");
		if($tipo == 0){
			$tipo = "Furto";
		}
		if($tipo == 1){
			$tipo = "Roubo";
		}
		if($tipo == 2){
			$tipo = "Agressão";
		}
		$insere = "INSERT INTO ocorrencia (CPF, Tipo, Cod_Endereco, Data_Envio, Status, Descricao) VALUES ('".$cpf."', '".$tipo."', '".$id_endereco."', '".$data_envio."', '0', '".$descricao."')";
		pg_query($con, $insere) or die(pg_last_error($con));
		$numero_bo = Pega_NumBO($cpf, $id_endereco);
		var_dump($numero_bo);
		header("Location: mostra_boletim.php?numero_bo=".$numero_bo);
	}

	function Insere_Emergencia($cpf, $nome, $rg, $telefone, $logradouro, $numero, $bairro, $complemento, $cidade, $estado, $tipo, $descricao){
		include "db.php";
		Checa_Solicitante($cpf, $nome, $rg, $telefone);
		$id_endereco = Insere_Endereco($logradouro, $numero, $bairro, $complemento, $cidade, $estado);
		$data_envio = date("Y-m-d H:i:s");
		if($tipo == 0){
			$tipo = "Acidente";
		}
		if($tipo == 1){
			$tipo = "Ocorrencia";
		}
		$insere = "INSERT INTO Emergencia (CPF, Cod_Endereco, Tipo, Data_Envio, Status, Descricao) VALUES ('".$cpf."', '".$id_endereco."','".$tipo."', '".$data_envio."', '0', '".$descricao."')";
		pg_query($con, $insere) or die(pg_last_error($con));
	}

	function Insere_Endereco($logradouro, $numero, $bairro, $complemento, $cidade, $estado){
		include "db.php";
		$insere = "INSERT INTO endereco (Logradouro, Numero, Bairro, Cidade, Estado, Complemento) VALUES ('".$logradouro."', '".$numero."', '".$bairro."', '".$cidade."', '".$estado."', '".$complemento."')";
		pg_query($con, $insere) or die(pg_last_error($con));

		$seleciona = "SELECT Cod_Endereco FROM endereco WHERE Logradouro = '".$logradouro."' AND Numero = '".$numero."' AND Bairro = '".$bairro."' AND Cidade = '".$cidade."' AND Estado = '".$estado."' AND Complemento = '".$complemento."' ORDER BY Cod_Endereco DESC";
		$query = pg_query($con, $seleciona) or die(pg_last_error($con));
		$campo = pg_fetch_object($query);
		$id_endereco = $campo->cod_endereco;

		return $id_endereco;
	}

	function Pega_NumBO($cpf, $id_endereco){
		include "db.php";
		$sql = "SELECT Cod_Ocorrencia FROM ocorrencia WHERE CPF = '".$cpf."' AND Cod_Endereco = '".$id_endereco."'";
		$query = pg_query($con, $sql) or die(pg_last_error($con));
		$campo = pg_fetch_object($query);
		$id_bo = $campo->cod_ocorrencia;
		return $id_bo;
	}

	function Checa_Registro($registro){
		include "db.php";
		$select = "SELECT * FROM administrativo WHERE Registro='".$registro."'";
		$consulta = pg_query($con, $select);
		$existe = pg_num_rows($consulta);
		if($existe == 0){
			return 1;
		}
		else{
			return 0;
		}
	}

	function Checa_Solicitante($cpf, $nome, $rg, $telefone){
		include "db.php";
		$select = "SELECT * FROM solicitante WHERE cpf='".$cpf."'";
		$consulta = pg_query($con, $select);
		$existe = pg_num_rows($consulta);
		if($existe == 0){
			$select = "INSERT INTO solicitante (CPF, Nome, RG, Telefone) VALUES ('".$cpf."','".$nome."','".$rg."', '".$telefone."') ";
			pg_query($con, $select) or die(pg_last_error($con));
		}
	}

	function Elenca_BO($parametro, $input){
		include "db.php";
		$numero[] = ''; $Data[] = ''; $Status[] = '';
		if($parametro == "numero_bo"){
			$seleciona = "SELECT * from ocorrencia WHERE Cod_Ocorrencia = '".$input."'";
			$query = pg_query($con, $seleciona) or die(pg_last_error($con));
			$campo = pg_fetch_object($query);
			$existe = pg_num_rows($query);
			if($existe == 0){
				return;
			}
			$Numero[1] = $campo->cod_Ocorrencia;
			$Data[1] = $campo->data_Envio;
			$Status[1] = $campo->status;
			$cont = 2;
		}
		else{
			if($parametro == "cpf"){
				$seleciona = "SELECT * FROM ocorrencia INNER JOIN solicitante ON ocorrencia.CPF = solicitante.CPF WHERE solicitante.CPF = '".$input."'";
			}
			if($parametro == "geral"){
				$seleciona = "SELECT * FROM ocorrencia ORDER BY Data_Envio DESC, Status";
			}
			$query = pg_query($con, $sql) or die(pg_last_error($con));
			$cont = 1;
			while($campo = pg_fetch_array($query)){
				$Numero[$cont] = $campo['Cod_Ocorrencia'];
				$Data[$cont] = $campo['Data_Envio'];
				$Status[$cont] = $campo['Status'];
				$cont++;
			}
		}
		$cont--;
		for ($i=1; $i <= $cont; $i++) { 
			switch ($Status[$i]) {
				case '0':
					$msg = "Esperando Validação";
					break;
				
				case '1':
					$msg = "Recebido";
					break;

				case '2':
					$msg = "Finalizado";
					break;
			}
			echo '
				<tr> 
				  <td><p>'.$Numero[$i].'</p></td>
				  <td style="text-align: center;"><p>'.$Data[$i].'</p></td>
				  <td><a href="mostra_boletim_adm.php?numero_bo='.$Numero[$i].'"><button>Ver</button></a></td>
				  <td><p>'.$msg.'</p></td>';
			if($parametro == "geral"){
				echo '<td><a href="mudar_status.php?numero='.$Numero[$i].'&oco=bo"><button style="width: auto;">Mudar</button></a></td>';
			}
				echo '
				</tr>
			';
		}
	}

	function Elenca_Emergencias($parametro){
		switch ($parametro) {
			case 0:
				$seleciona = "SELECT * FROM emergencia ORDER BY Data_Envio DESC, Status";
				break;
			
			case 1:
				$seleciona = "SELECT * FROM emergencia WHERE Tipo = '0' ORDER BY Data_Envio DESC, Status";
				break;

			case 2:
				$seleciona = "SELECT * FROM emergencia WHERE Tipo = '1' ORDER BY Data_Envio DESC, Status";
				break;
		}
		include "db.php";		
		$numero[] = ''; $Data[] = ''; $Status[] = '';
		$query = pg_query($con, $sql) or die(pg_last_error($con));
		$cont = 1;
		while($campo = pg_fetch_array($query)){
			$Numero[$cont] = $campo['Cod_Emergencia'];
			$Tipo[$cont] = $campo['Tipo'];
			$Data[$cont] = $campo['Data_Envio'];
			$Status[$cont] = $campo['Status'];
			$cont++;
		}
		$cont--;
		for ($i=1; $i <= $cont; $i++) { 
			if($Tipo[$i] == 1){
				$Emergencia = "Polícia";
			}else{
				$Emergencia = "Ambulância";
			}

			switch ($Status[$i]) {
				case '0':
					$msg = "Esperando";
					break;
				
				case '1':
					$msg = "Recebido";
					break;

				case '2':
					$msg = "Finalizado";
					break;
			}

			echo '
				<tr> 
				  <td><p>'.$Emergencia.'</p></td>
				  <td style="text-align: center;"><p>'.$Data[$i].'</p></td>
				  <td><a href="mostra_emergencia.php?numero_emergencia='.$Numero[$i].'"><button>Ver</button></a></td>
				  <td><p>'.$msg.'</p></td>
				  <td><a href="mudar_status.php?numero='.$Numero[$i].'&oco=eme"><button style="width: auto;">Mudar</button></a></td>
				</tr>
			';
		}
	}

	function Infos_Emergencia($input){
		include "db.php";		
		$seleciona = "SELECT * FROM emergencia INNER JOIN solicitante ON emergencia.CPF = solicitante.CPF INNER JOIN endereco ON emergencia.Cod_Endereco = endereco.Cod_Endereco WHERE emergencia.Cod_Emergencia = '".$input."'";
		$query = pg_query($con, $seleciona) or die(pg_last_error($con));
		$campo= pg_fetch_object($query);
		return $campo;
	}

	function Infos_BO($input){
		include "db.php";		
		$seleciona = "SELECT * FROM ocorrencia INNER JOIN solicitante ON ocorrencia.CPF = solicitante.CPF INNER JOIN endereco ON ocorrencia.Cod_Endereco = endereco.Cod_Endereco WHERE ocorrencia.Cod_Ocorrencia = '".$input."'";
		$query = pg_query($con, $seleciona) or die(pg_last_error($con));
		$campo = pg_fetch_object($query);
		return $campo;
	}

	function Muda_Status($input, $tipo){
		include "db.php";
		if($tipo == "Emergência"){

			$select = "SELECT Status from emergencia WHERE Cod_Emergencia = '".$input."'";
			$query = pg_query($con, $select) or die(pg_last_error($con));
			$campo= pg_fetch_object($query);
			$Status = $campo->status;
			if($Status < 2){
				$Status++;
			}
			$sql = "UPDATE emergencia SET Status = '".$Status."' WHERE Cod_Emergencia = '".$input."'";
			$query = pg_query($con, $sql) or die(pg_last_error($con));

		}
		if($tipo == "Ocorrência"){

			$select = "SELECT Status from ocorrencia WHERE Cod_Ocorrencia = '".$input."'";
			$query = pg_query($con, $select) or die(pg_last_error($con));
			$campo = pg_fetch_object($query);
			$Status = $campo->status;
			if($Status < 2){
				$Status++;
			}
			$altera = "UPDATE ocorrencia SET Status = '".$Status."' WHERE Cod_Ocorrencia = '".$input."'";
			$query = pg_query($con, $altera) or die(pg_last_error($con));

		}
	}

	function login($registro, $senha){
		include "db.php";

		$select = "select * from seleciona_administrativo('".$registro."', '".$senha."')";
		$query = pg_query($con, $select) or die(pg_last_error($con));
		$campo = pg_fetch_object($query);

		if(isset($campo->tipo)){
			$tipo = $campo->tipo;
		}
		else{
			$tipo = -1;
		}
		if($tipo != -1){
			$_SESSION["usuario"] = $registro;
			$_SESSION["senha"] = $senha;
			$_SESSION["tipo"] = $tipo;
			return $tipo;
		}
		else{
			$_SESSION["tipo"] = $tipo;
			return -1;
		}
	}

	function Cria_Usuario($registro, $senha, $tipo){
		include "db.php";
		$podesalvar = Checa_Registro($registro);
		if($podesalvar == 1){
			$select = "INSERT INTO administrativo (Registro, Senha, Tipo) VALUES ('".$registro."', '".$senha."', '".$tipo."')";
			pg_query($con, $select) or die(pg_last_error($con));
			return 1;
		}
		else{
			return 0;
		}
	}
?>