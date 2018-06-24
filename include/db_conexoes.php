<?php

	function Insere_BO($tipo, $logradouro, $numero, $bairro, $complemento, $cidade, $estado, $descricao, $nome, $rg, $cpf, $telefone){
		include "db.php";
		Checa_Solicitante($cpf, $nome, $rg, $telefone);
		$id_endereco = Insere_Endereco($logradouro, $numero, $bairro, $complemento, $cidade, $estado);
		$data_envio = date("Y-m-d H:i:s");
		$sql = "INSERT INTO ocorrencia (CPF, Tipo, Cod_Endereco, Data_Envio, Status_Ocorrencia, Descricao) value ('".$cpf."', '".$tipo."', '".$id_endereco."', '".$data_envio."', '0', '".$descricao."')";
		mysqli_query($con, $sql) or die("erroinsereocorrencia:".mysqli_error($con));
		$numero_bo = Pega_NumBO($cpf, $id_endereco);
		var_dump($numero_bo);
		header("Location: mostra_boletim.php?numero_bo=".$numero_bo);
	}

	function Insere_Emergencia($cpf, $nome, $rg, $telefone, $logradouro, $numero, $bairro, $complemento, $cidade, $estado, $tipo, $descricao){
		include "db.php";
		Checa_Solicitante($cpf, $nome, $rg, $telefone);
		$id_endereco = Insere_Endereco($logradouro, $numero, $bairro, $complemento, $cidade, $estado);
		$data_envio = date("Y-m-d H:i:s");
		$sql = "INSERT INTO Emergencia (CPF, Cod_Endereco, Tipo, Data_Envio, Status_Emergencia, Descricao) value ('".$cpf."', '".$id_endereco."','".$tipo."', '".$data_envio."', '0', '".$descricao."')";
		mysqli_query($con, $sql) or die("erroinsereemergencia:".mysqli_error($con));
	}

	function Insere_Endereco($logradouro, $numero, $bairro, $complemento, $cidade, $estado){
		include "db.php";
		$sql = "INSERT INTO endereco (Logradouro, Numero, Bairro, Cidade, Estado, Complemento) value ('".$logradouro."', '".$numero."', '".$bairro."', '".$cidade."', '".$estado."', '".$complemento."')";
		mysqli_query($con, $sql) or die("errocriarendereco:".mysqli_error($con));

		$sql = "SELECT Cod_Endereco FROM endereco WHERE Logradouro = '".$logradouro."' AND Numero = '".$numero."' AND Bairro = '".$bairro."' AND Cidade = '".$cidade."' AND Estado = '".$estado."' AND Complemento = '".$complemento."' ORDER BY Cod_Endereco DESC";
		$query = mysqli_query($con, $sql) or die("erropegarendereco:".mysqli_error($con));
		$campo=mysqli_fetch_object($query);
		$id_endereco = $campo->Cod_Endereco;
		return $id_endereco;
	}

	function Pega_NumBO($cpf, $id_endereco){
		include "db.php";
		$sql = "SELECT Cod_Ocorrencia FROM ocorrencia WHERE CPF = '".$cpf."' AND Cod_Endereco = '".$id_endereco."'";
		$query = mysqli_query($con, $sql) or die("erropegarBO:".mysqli_error($con));
		$campo=mysqli_fetch_object($query);
		$id_bo = $campo->Cod_Ocorrencia;
		return $id_bo;
	}

	function Checa_Registro($registro){
		include "db.php";
		$sql = "SELECT * FROM administrativo WHERE Registro='".$registro."'";
		$consulta = mysqli_query($con, $sql);
		$existe = mysqli_num_rows($consulta);
		if($existe == 0){
			return 1;
		}
		else{
			return 0;
		}
	}

	function Checa_Solicitante($cpf, $nome, $rg, $telefone){
		include "db.php";
		$sql = "SELECT * FROM solicitante WHERE cpf='".$cpf."'";
		$consulta = mysqli_query($con, $sql);
		$existe = mysqli_num_rows($consulta);
		if($existe == 0){
			$sql = "INSERT INTO solicitante (CPF, Nome, RG, Telefone) value ('".$cpf."','".$nome."','".$rg."', '".$telefone."') ";
			mysqli_query($con, $sql) or die("errocriarsolicitante:".mysqli_error($con));
		}
	}

	function Elenca_BO($parametro, $input){
		include "db.php";
		$numero[] = ''; $Data[] = ''; $Status[] = '';
		if($parametro == "numero_bo"){
			$sql = "SELECT * from ocorrencia WHERE Cod_Ocorrencia = '".$input."'";
			$query = mysqli_query($con, $sql) or die("erro_pegar_elecaBO:".mysqli_error($con));
			$campo=mysqli_fetch_object($query);
			$Numero[1] = $campo->Cod_Ocorrencia;
			$Data[1] = $campo->Data_Envio;
			$Status[1] = $campo->Status_Ocorrencia;
			$cont = 2;
		}
		else{
			if($parametro == "cpf"){
				$sql = "SELECT * FROM ocorrencia INNER JOIN solicitante ON ocorrencia.CPF = solicitante.CPF WHERE solicitante.CPF = '".$input."'";
			}
			if($parametro == "geral"){
				$sql = "SELECT * FROM ocorrencia";
			}
			$query = mysqli_query($con, $sql) or die("erro_pegar_elecaBO:".mysqli_error($con));
			$cont = 1;
			while($campo = mysqli_fetch_array($query)){
				$Numero[$cont] = $campo['Cod_Ocorrencia'];
				$Data[$cont] = $campo['Data_Envio'];
				$Status[$cont] = $campo['Status_Ocorrencia'];
				$cont++;
			}
		}
		$cont--;
		for ($i=1; $i <= $cont; $i++) { 
			echo '
				<tr> 
				  <td><p>'.$Numero[$i].'</p></td>
				  <td style="text-align: center;"><p>'.$Data[$i].'</p></td>
				  <td><a href="mostra_boletim.php?numero_bo='.$Numero[$i].'"><button>Ver</button></a></td>
				  <td><p>'.$Status[$i].'</p></td>';
			if($parametro == "geral"){
				echo '<td><a href="mudar_status.php?numero='.$Numero[$i].'&oco=bo"><button>Mudar</button></a></td>';
			}
				echo '
				</tr>
			';
		}
	}

	function Elenca_Emergencias($parametro){
		switch ($parametro) {
			case 0:
				$sql = "SELECT * FROM emergencia ORDER BY Data_Envio DESC";
				break;
			
			case 1:
				$sql = "SELECT * FROM emergencia WHERE Tipo = '0'";
				break;

			case 2:
				$sql = "SELECT * FROM emergencia WHERE Tipo = '1'";
				break;
		}
		include "db.php";		
		$numero[] = ''; $Data[] = ''; $Status[] = '';
		$query = mysqli_query($con, $sql) or die("erro_pegar_elecaEmergencia:".mysqli_error($con));
		$cont = 1;
		while($campo = mysqli_fetch_array($query)){
			$Numero[$cont] = $campo['Cod_Emergencia'];
			$Tipo[$cont] = $campo['Tipo'];
			$Data[$cont] = $campo['Data_Envio'];
			$Status[$cont] = $campo['Status_Emergencia'];
			$cont++;
		}
		$cont--;
		for ($i=1; $i <= $cont; $i++) { 
			if($Tipo[$i] == 1){
				$Emergencia = "Polícia";
			}else{
				$Emergencia = "Ambulância";
			}
			echo '
				<tr> 
				  <td><p>'.$Emergencia.'</p></td>
				  <td style="text-align: center;"><p>'.$Data[$i].'</p></td>
				  <td><a href="mostra_emergencia.php?numero_emergencia='.$Numero[$i].'"><button>Ver</button></a></td>
				  <td><p>'.$Status[$i].'</p></td>
				  <td><a href="mudar_status.php?numero='.$Numero[$i].'&oco=eme"><button>Mudar</button></a></td>
				</tr>
			';
		}
	}

	function Infos_Emergencia($input){
		include "db.php";		
		$sql = "SELECT * FROM emergencia INNER JOIN solicitante ON emergencia.CPF = solicitante.CPF INNER JOIN endereco ON emergencia.Cod_Endereco = endereco.Cod_Endereco WHERE emergencia.Cod_Emergencia = '".$input."'";
		$query = mysqli_query($con, $sql) or die("erro_infos_bo_emergencia:".mysqli_error($con));
		$campo=mysqli_fetch_object($query);
		return $campo;
	}

	function Infos_BO($input){
		include "db.php";		
		$sql = "SELECT * FROM ocorrencia INNER JOIN solicitante ON ocorrencia.CPF = solicitante.CPF INNER JOIN endereco ON ocorrencia.Cod_Endereco = endereco.Cod_Endereco WHERE ocorrencia.Cod_Ocorrencia = '".$input."'";
		$query = mysqli_query($con, $sql) or die("erro_infos_bo_ocorrencia:".mysqli_error($con));
		$campo=mysqli_fetch_object($query);
		return $campo;
	}

	function Muda_Status($input, $tipo){
		include "db.php";
		if($tipo == "Emergência"){
			$select = "SELECT Status_Emergencia from emergencia WHERE Cod_Emergencia = '".$input."'";
			$query = mysqli_query($con, $select) or die("erro_consuta_status_emergencia:".mysqli_error($con));
			$campo=mysqli_fetch_object($query);
			$Status = $campo->Status_Emergencia;
			if($Status < 2){
				$Status++;
			}
			$sql = "UPDATE emergencia SET Status_Emergencia = '".$Status."' WHERE Cod_Emergencia = '".$input."'";
			$query = mysqli_query($con, $sql) or die("erro_update_emergencia:".mysqli_error($con));
		}
		if($tipo == "Ocorrência"){
			$select = "SELECT Status_Ocorrencia from ocorrencia WHERE Cod_Ocorrencia = '".$input."'";
			$query = mysqli_query($con, $select) or die("erro_consuta_status_ocorrência:".mysqli_error($con));
			$campo=mysqli_fetch_object($query);
			$Status = $campo->Status_Ocorrencia;
			if($Status < 2){
				$Status++;
			}
			$sql = "UPDATE ocorrencia SET Status_Ocorrencia = '".$Status."' WHERE Cod_Ocorrencia = '".$input."'";
			$query = mysqli_query($con, $sql) or die("erro_update_ocorrencia:".mysqli_error($con));
		}
	}

	function login($registro, $senha){
		include "db.php";
		//session_start();
		$select = "SELECT * from administrativo WHERE Registro = '".$registro."' AND Senha = '".$senha."'";
		$query = mysqli_query($con, $select) or die("erro_login:".mysqli_error($con));
		$campo=mysqli_fetch_object($query);
		if(isset($campo->Tipo))
			$tipo = $campo->Tipo;
		else
			$tipo = -1;
		if($tipo >= 0){
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
			$sql = "INSERT INTO administrativo (Registro, Senha, Tipo) value ('".$registro."', '".$senha."', '".$tipo."')";
			mysqli_query($con, $sql) or die("erroinsereocorrencia:".mysqli_error($con));
			return 1;
		}
		else{
			return 0;
		}
	}
?>