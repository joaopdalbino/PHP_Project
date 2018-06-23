<?php
	function Insere_BO($tipo, $logradouro, $numero, $bairro, $complemento, $cidade, $estado, $descricao, $nome, $rg, $cpf){
		include "db.php";
		Checa_Solicitante($cpf, $nome, $rg);
		$id_endereco = Insere_Endereco($logradouro, $numero, $bairro, $complemento, $cidade, $estado);
		$data_envio = date("Y-m-d H:i:s");
		$sql = "INSERT INTO ocorrencia (CPF, Tipo, Cod_Endereco, Data_Envio, Status_Ocorrencia, Descricao) value ('".$cpf."', '".$tipo."', '".$id_endereco."', '".$data_envio."', '0', '".$descricao."')";
		echo $sql."<br>";
		mysqli_query($con, $sql) or die("erroinsereocorrencia:".mysqli_error($con));
		//header("Location: index.php?numero_bo");
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
	function Insere_Endereco($logradouro, $numero, $bairro, $complemento, $cidade, $estado){
		include "db.php";
		$sql = "INSERT INTO endereco (Logradouro, Numero, Bairro, Cidade, Estado, Complemento) value ('".$logradouro."', '".$numero."', '".$bairro."', '".$cidade."', '".$estado."', '".$complemento."')";
		mysqli_query($con, $sql) or die("errocriarendereco:".mysqli_error($con));

		$sql = "SELECT Cod_Endereco FROM endereco WHERE Logradouro = '".$logradouro."' AND Numero = '".$numero."' AND Bairro = '".$bairro."' AND Cidade = '".$cidade."' AND Estado = '".$estado."' AND Complemento = '".$complemento."'";
		$query = mysqli_query($con, $sql) or die("erropegarendereco:".mysqli_error($con));
		$campo=mysqli_fetch_object($query);
		$id_endereco = $campo->Cod_Endereco;
		return $id_endereco;
	}
?>