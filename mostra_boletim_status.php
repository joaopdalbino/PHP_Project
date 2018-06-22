<!DOCTYPE html>
<html>
<?php
	include "include/db.php";
	//include "consulta_BO.php";
	include "include/topo.php";
	$id = $_GET["dado"];
	$parametro = $_GET["parametro"]
	//$estado = "SP"
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
		            	<option value=""><?php echo $id; ?></option>
		            </select>
		            <input name="status" type="text" id="status" placeholder="<?php echo $status; ?>" disabled>
		        </td>
		      </tr>
		  </form>
		</div>
		<!-- FORM PARA CADASTRO -->

	</div>
</body>
<script>
	function volta(){
		window.location.href = 'administrativo.php';
	}
</script>
</html>