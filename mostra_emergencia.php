<!DOCTYPE html>
<html>
<?php
	include "include/db.php";
	include "include/topo.php";
	$id = $_GET["id"];
	$tipo = $_GET["tipo"];
	$estado = "SP"
?>
<body>
	<div id="wrap">
		<?php include "include/menu_administrativo.php"; ?>
		<!-- FORM PARA CADASTRO BO -->
		<div id="form_acidente" class="formularios">
			<form action="">
		  	<h1>Ver Detalhes</h1>
		    <table border="0" cellspacing="0" cellpadding="0">
		      <tr>
		        <td>
		            <input name="rua" type="text " id="rua" placeholder="Rua" disabled>
		            <input name="numero" type="text " id="numero" placeholder="Número" disabled>
		            <input name="bairro" type="text " id="bairro" placeholder="Bairro" disabled>
		            <input name="complemento" type="text " id="complemento" placeholder="Complemento" disabled>
		            <select name="estado" disabled>
		            	<option value=""><?php echo $estado; ?></option>
		            </select>
		            <button name="voltar" onclick="go()" id="voltar" value="voltar">Voltar</button></a>
		            <button name="voltar" onclick="volta()" id="voltar" value="voltar">Voltar</button>
		        </td>
		      </tr>
		  </form>
		</div>
		<!-- FORM PARA CADASTRO -->

	</div>
</body>
<script>
	function volta(){
		//window.location.href = 'administrativo.php';
	}
	function go(){

	}
</script>
</html>