<?php

	function Insere_BO($tipo, $logradouro, $numero, $bairro, $complemento, $cidade, $estado, $descricao, $nome, $rg, $cpf){
		include "db.php";
		Checa_Solicitante($cpf, $nome, $rg);
		$id_endereco = Insere_Endereco($logradouro, $numero, $bairro, $complemento, $cidade, $estado);
		$data_envio = date("Y-m-d H:i:s");
		$sql = "INSERT INTO ocorrencia (CPF, Tipo, Cod_Endereco, Data_Envio, Status_Ocorrencia, Descricao) value ('".$cpf."', '".$tipo."', '".$id_endereco."', '".$data_envio."', '0', '".$descricao."')";
		mysqli_query($con, $sql) or die("erroinsereocorrencia:".mysqli_error($con));
		$numero_bo = Pega_NumBO($cpf, $id_endereco);
		var_dump($numero_bo);
		header("Location: mostra_boletim.php?numero_bo=".$numero_bo);
	}

	function Insere_Emergencia($cpf, $nome, $rg, $logradouro, $numero, $bairro, $complemento, $cidade, $estado, $tipo, $descricao){
		include "db.php";
		Checa_Solicitante($cpf, $nome, $rg);
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

	function Checa_Solicitante($cpf, $nome, $rg){
		include "db.php";
		$sql = "SELECT * FROM solicitante WHERE cpf='".$cpf."'";
		$consulta = mysqli_query($con, $sql);
		$existe = mysqli_num_rows($consulta);
		if($existe == 0){
			$sql = "INSERT INTO solicitante (CPF, Nome, RG) value ('".$cpf."','".$nome."','".$rg."') ";
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
		elseif($parametro == "cpf"){
			$sql = "SELECT * FROM ocorrencia INNER JOIN solicitante ON ocorrencia.CPF = solicitante.CPF WHERE solicitante.CPF = '".$input."'";
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
				  <td><p>'.$Status[$i].'</p></td>
				</tr>
			';
		}
	}

	function Elenca_Emergencias(){
		include "db.php";		
		$numero[] = ''; $Data[] = ''; $Status[] = '';
		$sql = "SELECT * FROM emergencia";
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
				  <td><a href="mudar_status.php?numero_emergencia='.$Numero[$i].'"><button>Mudar</button></a></td>
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

	function Muda_Status($input){
		include "db.php";
		$select = "SELECT Status_Emergencia from Emergencia WHERE Cod_Emergencia = '".$input."'";
		$query = mysqli_query($con, $select) or die("erro_consuta_status_emergencia:".mysqli_error($con));
		$campo=mysqli_fetch_object($query);
		$Status = $campo->Status_Emergencia;
		if($Status < 2){
			$Status++;
		}
		$sql = "UPDATE emergencia SET Status_Emergencia = '".$Status."' WHERE Cod_Emergencia = '".$input."'";
		$query = mysqli_query($con, $sql) or die("erro_update_emergencia:".mysqli_error($con));
	}

	function login($registro, $senha){
		include "db.php";
		$select = "SELECT Tipo from administrativo WHERE Registro = '".$registro."' AND Senha = '".$senha."'";
		$query = mysqli_query($con, $select) or die("erro_login:".mysqli_error($con));
		$campo=mysqli_fetch_object($query);
		$tipo = $campo->Tipo;
		if(isset($tipo)){
			$_SESSION["usuario"] = $registro;
			$_SESSION["senha"] = $senha;
			$_SESSION["tipo"] = $tipo;
			return $tipo;
		}
		else{
			return -1;
		}
	}
?>