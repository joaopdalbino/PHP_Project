<!DOCTYPE html>
<html>
<?php
	include "include/db_conexoes.php";
	include "include/topo.php";
	$id = $_GET["numero_emergencia"];
	$campo = Infos_Emergencia($id);
	switch ($campo->Status_Emergencia) {
		case '0':
			$msg = "Esperando Validação.";
			break;
		
		case '1':
			$msg = "Recebido.";
			break;

		case '2':
			$msg = "Finalizado.";
			break;
	}
	switch ($campo->Tipo) {
		case '0':
			$msg2 = "Ambulância.";
			break;
		
		case '1':
			$msg2 = "Polícia.";
			break;
	}
?>
<body>
	<div id="wrap">
		<?php include "include/menu_administrativo.php"; ?>
		<!-- FORM PARA CADASTRO BO -->
		<div id="form_bo" class="formularios">
			<h1>Emergência</h1>
		    <table border="0" cellspacing="0" cellpadding="0">
		      <tr>
		        <td>
		        	<input name="numero_emergencia" type="text " id="numero_bo" value="Nº Emergência: <?php echo $id; ?>" disabled>
		        	<input name="tipo" type="text " id="tipo" value="Emergência: <?php echo $msg2; ?>" disabled>
		        	<input name="status" type="text " id="status" value="Status: <?php echo $msg; ?>" disabled>
		        	<input name="nome" type="text" id="nome" value="<?php echo $campo->Nome; ?>" disabled>
		            <input name="CPF" type="text" id="CPF" value="<?php echo $campo->CPF; ?>" disabled>
		            <input name="RG" type="text" id="RG" value="<?php echo $campo->RG; ?>" disabled>
		            <input type="date" name="data" id="data" value="<?php echo $campo->Data_Envio; ?>" disabled>
		            <input name="logradouro" type="text " id="logradouro" value="<?php echo $campo->Logradouro; ?>" disabled>
		            <input name="numero" type="text " id="numero" value="<?php echo $campo->Numero; ?>" disabled>
		            <input name="cidade" type="text " id="cidade" value="<?php echo $campo->Cidade; ?>" disabled>
		            <input name="bairro" type="text " id="bairro" value="<?php echo $campo->Bairro; ?>" disabled>
		            <input name="complemento" type="text " id="complemento" value="<?php echo $campo->Complemento; ?>" disabled>
		            <select name="estado" disabled>
		            	<option value=""><?php echo $campo->Estado; ?></option>
		            </select>
		            <textarea name="boletim" id="boletim" rows="10" cols="50" disabled><?php echo $campo->Descricao; ?></textarea>
		            <a href="administrativo.php"><button value="envio">Voltar</button></a>
		        </td>
		      </tr>
		    </table>
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