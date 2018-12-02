<?php

	function insere_ocorrencia($ocorrencia, $string){
		
		$query = "INSERT INTO ".$ocorrencia." (
					sol.CPF, sol.Nome, sol.RG, sol.Telefone,
		     		en.Logradouro, en.Numero, en.Bairro, en.Cidade, en.Estado, 
		     		tipo, en.Complemento, Data_Envio, Status, Descricao
		    ) 
			VALUES 
			(
				'".$string['cpf']."','".$string['nome']."','".$string['rg']."','".$string['telefone']."', 
		    	'".$string['logradouro']."', '".$string['numero']."', '".$string['bairro']."', '".$string['cidade']."', '".$string['estado']."', 
		     	'".$string['tipo']."','".$string['complemento']."', NOW(), 0, '".$string['desc']."'
		    )";

		return $query;
	}


	function Insere_BO($params){
		include "db.php";
		
		pg_query($con, insere_ocorrencia("ocorrencia", $params)) or die(pg_last_error($con));
		header("Location: mostra_boletim.php?numero_bo=".Pega_NumBO($params['cpf'], $params['logradouro']));
	}

	function Insere_Emergencia($params){
		include "db.php";

		pg_query($con, insere_ocorrencia("emergencia", $params)) or die(pg_last_error($con));
	}


	function Pega_NumBO($cpf, $logradouro){
		include "db.php";
		$seleciona = "SELECT Cod_Ocorrencia FROM ocorrencia WHERE (sol).CPF = '".$cpf."' AND (en).Logradouro = '".$logradouro."'";
		$query = pg_query($con, $seleciona) or die(pg_last_error($con));
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
			$Numero[1] = $campo->cod_ocorrencia;
			$Data[1] = $campo->data_envio;
			$Status[1] = $campo->status;
			$cont = 2;
		}
		else{
			if($parametro == "cpf"){
				$seleciona = "SELECT * FROM ocorrencia WHERE (sol).CPF = '".$input."'";
			}
			if($parametro == "geral"){
				$seleciona = "SELECT * FROM ocorrencia ORDER BY Data_Envio DESC, Status";
			}
			$query = pg_query($con, $seleciona) or die(pg_last_error($con));
			$cont = 1;
			while($campo = pg_fetch_array($query)){
				$Numero[$cont] = $campo['cod_ocorrencia'];
				$Data[$cont] = $campo['data_envio'];
				$Status[$cont] = $campo['status'];
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
				';

			if ($parametro == "geral"){
				echo '
				  <td><a href="mostra_boletim_adm.php?numero_bo='.$Numero[$i].'"><button>Ver</button></a></td>
			';
			}
			else{
				echo '
				  <td><a href="mostra_boletim.php?numero_bo='.$Numero[$i].'"><button>Ver</button></a></td>
			';
			}
			echo '
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

		$ambulancia = array('Acidente', 'Ocorrencia');
		$policia = array('Furto', 'Roubo', 'Agressão');
		$bo = array('Assédio Sexual', 'Assédio Moral');

		switch ($parametro) {
			case 0:
				$seleciona = "SELECT * FROM emergencia ORDER BY Data_Envio DESC, Status";
				break;
			
			case 1:
				$seleciona = "SELECT * FROM emergencia WHERE tipo = 'Acidente' OR tipo = 'Ocorrencia' ORDER BY Data_Envio DESC, Status";
				break;

			case 2:
				$seleciona = "SELECT * FROM emergencia WHERE tipo = 'Furto' OR tipo = 'Roubo' OR tipo = 'Agressão' ORDER BY Data_Envio DESC, Status";
				break;
		}
		include "db.php";		
		$numero[] = ''; $Data[] = ''; $Status[] = '';
		$query = pg_query($con, $seleciona) or die(pg_last_error($con));
		$cont = 1;
		while($campo = pg_fetch_array($query)){
			$Numero[$cont] = $campo['cod_emergencia'];
			$Tipo[$cont] = $campo['tipo'];
			$Data[$cont] = $campo['data_envio'];
			$Status[$cont] = $campo['status'];
			$cont++;
		}
		$cont--;

		for ($i=1; $i <= $cont; $i++) { 
		
			if(in_array($Tipo[$i], $ambulancia)){
				$Emergencia = 'Ambulância';
			}

			if(in_array($Tipo[$i], $policia)){
				$Emergencia = 'Polícia';
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
		$seleciona = "SELECT * FROM emergencia WHERE emergencia.Cod_Emergencia = '".$input."'";
		$query = pg_query($con, $seleciona) or die(pg_last_error($con));
		$campo= pg_fetch_object($query);
		
		$seleciona = "SELECT (en).* FROM emergencia WHERE emergencia.Cod_Emergencia = '".$input."'";
		$query = pg_query($con, $seleciona) or die(pg_last_error($con));
		$en = pg_fetch_object($query);

		$seleciona = "SELECT (sol).* FROM emergencia WHERE emergencia.Cod_Emergencia = '".$input."'";
		$query = pg_query($con, $seleciona) or die(pg_last_error($con));
		$sol = pg_fetch_object($query);

		$string = [
			'campo' => $campo,
			'en' => $en,
			'sol' => $sol
		];

		return $string;

	}

	function Infos_BO($input){
		include "db.php";		
		$seleciona = "SELECT * FROM ocorrencia WHERE ocorrencia.Cod_Ocorrencia = '".$input."'";
		$query = pg_query($con, $seleciona) or die(pg_last_error($con));
		$campo = pg_fetch_object($query);

		$seleciona = "SELECT (en).* FROM ocorrencia WHERE ocorrencia.Cod_Ocorrencia = '".$input."'";
		$query = pg_query($con, $seleciona) or die(pg_last_error($con));
		$en = pg_fetch_object($query);

		$seleciona = "SELECT (sol).* FROM ocorrencia WHERE ocorrencia.Cod_Ocorrencia = '".$input."'";
		$query = pg_query($con, $seleciona) or die(pg_last_error($con));
		$sol = pg_fetch_object($query);

		$string = [
			'campo' => $campo,
			'en' => $en,
			'sol' => $sol
		];

		return $string;
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
			$seleciona = "UPDATE emergencia SET Status = '".$Status."' WHERE Cod_Emergencia = '".$input."'";
			$query = pg_query($con, $seleciona) or die(pg_last_error($con));

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