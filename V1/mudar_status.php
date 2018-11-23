<?php 
	$id = $_GET["numero"];
	include "include/db_conexoes.php";
	if($_GET["oco"] == "eme"){
		Muda_Status($id, "Emergência");
	}
	if($_GET["oco"] == "bo"){
		Muda_Status($id, "Ocorrência");
	}
	header("Location: administrativo.php");
?>