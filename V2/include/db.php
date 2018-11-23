<?php

	// error_reporting(E_ALL);
	// ini_set('display_errors', 'On');
	
	if(!@($con=pg_connect("host=localhost dbname=postgres port=5432 password=123"))) {
	   print "Não foi possível estabelecer uma conexão com o banco de dados.";
	} else {
	   //pg_close ($conexao);
	   //print "Conexão OK!"; 
	}
?>