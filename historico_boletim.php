<!DOCTYPE html>
<html>
<?php
	include "include/topo.php";
	include "include/consulta_BO.php";
?>
<body>
	<div id="wrap">
		<?php include "include/menu.php"; ?>

		<!-- FORM PARA CADASTRO PESSOA -->
		<div class="formularios">
		  <form name="form1" id="form1" action="mostra_boletim_status.php" method="GET" enctype="text/plain">
		  	<h1>Procurar</h1>
		    <select id="parametro">
		        <option value="endereco">Endereço</option>
		        <option value="numero_bo">Número BO</option>
		        <option value="descricao">Descrição</option>
		    </select>
		    <input name="dado" type="text" id="dado" placeholder="Escreva o dado">
		    <button name="confirma" onclick="mostrar_bo()" typle="submit" id="confirma" value="Confirma">Procurar</button>
		  </form>
		</div>
		<!-- FORM PARA CADASTRO -->

	</div>
</body>
<script type="text/javascript">

</script>
</html>