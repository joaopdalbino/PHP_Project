<?php
	$servername = "127.0.0.1";
	$username = "root";
	$password = "banco";
	$schema = "BO";
	$con = mysqli_connect($servername, $username, $password, $schema);
	mysqli_query($con, "SET NAMES 'utf8'");
	mysqli_query($con, "SET character_set_connection=utf8");
	mysqli_query($con, "SET character_set_client=utf8");
	mysqli_query($con, "SET character_set_results=utf8");
	
	if ($con){
		mysqli_select_db($con, "BO");
	}
	else{
		echo "Conexão com o banco de dados falhou, tente novamente.";
	}
?>