<!DOCTYPE html>
<html>
<?php
	include "include/topo.php";
?>
<body>
	<div id="wrap">
		<?php include "include/menu.php"; ?>

		<!-- FORM PARA CADASTRO PESSOA -->
		<div class="formularios">
		  <form name="form1" id="form1" action="mostra_boletim_status.php" method="post">
		  	<h1>Procurar</h1>
		    <select name="parametro">
		        <option value="cpf">CPF</option>
		        <option value="numero_bo">Número BO</option>
		    </select>
		    <input name="dado" type="text" id="dado" placeholder="Escreva o dado">
		    <button name="confirma" type="submit" id="confirma">Procurar</button>
		  </form>
		</div>
		<!-- FORM PARA CADASTRO -->

	</div>
</body>
<script type="text/javascript">

</script>
</html>