<?php 
	$id = $_GET["numero_emergencia"];
	include "include/db_conexoes.php";
	Muda_Status($id);
	header("Location: administrativo.php");
?>