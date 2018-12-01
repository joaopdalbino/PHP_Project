<!DOCTYPE html>
<html>
<?php
	include "include/db_conexoes.php";
	include "include/topo.php";
	$id = $_GET["numero_emergencia"];
	$campo = Infos_Emergencia($id);
	switch ($campo['campo']->status) {
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
		        	<input name="tipo" type="text " id="tipo" value="Emergência: <?php echo $campo['campo']->tipo; ?>" disabled>
		        	<input name="status" type="text " id="status" value="Status: <?php echo $msg; ?>" disabled>
		        	<input name="nome" type="text" id="nome" value="<?php echo $campo['sol']->nome; ?>" disabled>
		            <input name="CPF" type="text" id="CPF" value="<?php echo $campo['sol']->cpf; ?>" disabled>
		            <input name="RG" type="text" id="RG" value="<?php echo $campo['sol']->rg; ?>" disabled>
		            <input name="telefone" type="text" id="telefone" value="<?php echo $campo['sol']->telefone; ?>" disabled>
		            <input type="date" name="data" id="data" value="<?php echo $campo['campo']->data_envio; ?>" disabled>
		            <input name="logradouro" type="text " id="logradouro" value="<?php echo $campo['en']->logradouro; ?>" disabled>
		            <input name="numero" type="text " id="numero" value="<?php echo $campo['en']->numero; ?>" disabled>
		            <input name="cidade" type="text " id="cidade" value="<?php echo $campo['en']->cidade; ?>" disabled>
		            <input name="bairro" type="text " id="bairro" value="<?php echo $campo['en']->bairro; ?>" disabled>
		            <input name="complemento" type="text " id="complemento" value="<?php echo $campo['en']->complemento; ?>" disabled>
		            <select name="estado" disabled>
		            	<option value=""><?php echo $campo['en']->estado; ?></option>
		            </select>
		            <textarea name="boletim" id="boletim" rows="10" cols="50" disabled><?php echo $campo['campo']->descricao; ?></textarea>
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