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
		  <form name="form1" id="form1" method="post" action="" enctype="text/plain">
		  	<h1>Procurar</h1>
		    <select id="select">
		        <option value="endereco">Endereço</option>
		        <option value="numero_bo">Número BO</option>
		        <option value="descricao">Descrição</option>
		    </select>
		    <input name="dado" type="text" id="dado" placeholder="Escreva o dado">
		    <button name="confirma" onclick="mostrar_bo()" type="submit" id="confirma" value="Confirma">Procurar</button>
		  </form>
		</div>
		<!-- FORM PARA CADASTRO -->
	</div>
</body>
<script type="text/javascript">
	
</script>
</html>