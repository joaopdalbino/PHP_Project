<?php 
	$registro = $_POST["registro"];
	$senha = $_POST["senha"];
	$tipo = $_POST["tipo"];
	include "db_conexoes.php";
	$resp = Cria_Usuario($registro, $senha, $tipo);
	if($resp == 1){
		header("Location: ../administrativo.php?mensagem=ok");
	}else{
		header("Location: ../administrativo.php?mensagem=erro");
	}
?>