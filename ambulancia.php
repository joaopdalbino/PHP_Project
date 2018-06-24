<!DOCTYPE html>
<html>
<?php
	include "include/topo.php";
	$enviado = $_POST["send"];
	if ($enviado != ""){
		//$descricao_emergencia = "[".$_POST["tipo"]."]: ".$_POST["descricao"];
	    include "include/db_conexoes.php";
	    Insere_Emergencia($_POST["CPF"], $_POST["nome"], $_POST["RG"], $_POST["logradouro"], $_POST["numero"], $_POST["bairro"], $_POST["complemento"], $_POST["cidade"], $_POST["estado"], 0, $_POST["descricao"]);
	}
?>
<body>
	<div id="wrap">
		<?php include "include/menu.php"; ?>
		
		<div class ="menu_central">
			<button id="btn_acidente" onclick="mostra_acidente()"> ACIDENTE </button>
			<button id="btn_ocorrencia" onclick="mostra_ocorrencia()"> OCORRÊNCIA </button>
		</div>

		<!-- FORM PARA CADASTRO BO -->
		<div id="form_acidente" class="formularios" style="display: none;">
		  <form name="form2" id="form2" method="post" action="">
		  	<h1>Solicitar Emergência</h1>
		    <table border="0" cellspacing="0" cellpadding="0">
		      <tr>
		        <td>
		        	<input name="tipo" type="text" id="tipo" disabled>
		        	<input name="nome" type="text" id="nome"placeholder="Nome" required>
		        	<input name="CPF" type="text" id="CPF" placeholder="CPF" required>
		            <input name="RG" type="text" id="RG" placeholder="RG" required>
		            <input name="logradouro" type="text" id="logradouro" placeholder="Logradouro" required>
		            <input name="numero" type="text" id="numero" placeholder="Número" required>
		            <input name="cidade" type="text" id="cidade" placeholder="Cidade" required>
		            <input name="bairro" type="text" id="bairro" placeholder="Bairro" required>
		            <input name="complemento" type="text" id="complemento" placeholder="Complemento">
		            <select name="estado" required>
		            	<option value="AC">Acre</option>
		            	<option value="AL">Alagoas</option>
		            	<option value="AP">Amapá</option>
		            	<option value="AM">Amazonas</option>
		            	<option value="BA">Bahia</option>
		            	<option value="CE">Ceará</option>
		            	<option value="DF">Distrito Federal</option>
		            	<option value="ES">Espírito Santo</option>
		            	<option value="GO">Goiás</option>
		            	<option value="MA">Maranhão</option>
		            	<option value="MT">Mato Grosso</option>
		            	<option value="MS">Mato Grosso do Sul</option>
		            	<option value="MG">Minas Gerais</option>
		            	<option value="PA">Pará</option>
		            	<option value="PB">Paraíba</option>
		            	<option value="PR">Paraná</option>
		            	<option value="PE">Pernambuco</option>
		            	<option value="PI">Piauí</option>
		            	<option value="RJ">Rio de Janeiro</option>
		            	<option value="RN">Rio Grande do Norte</option>
		            	<option value="RS">Rio Grande do Sul</option>
		            	<option value="RO">Rondônia</option>
		            	<option value="RR">Roraima</option>
		            	<option value="SC">Santa Catarina</option>
		            	<option value="SP">São Paulo</option>
		            	<option value="SE">Sergipe</option>
		            	<option value="TO">Tocantins</option>
		            </select>
		            <textarea name="descricao" id="descricao" rows="10" cols="50" placeholder="Descrição"></textarea>
		            <button name="send" type="submit" id="send" value="Send">Salvar</button>
		            <button name="voltar" onclick="volta()" id="voltar" value="voltar">Voltar</button>
		        </td>
		      </tr>
		    </table>
		  </form>
		</div>
		<!-- FORM PARA CADASTRO -->
	</div>
</body>

<script type="text/javascript">
	function mostra_ocorrencia(){
		$('#tipo').val("Ocorrencia");
		habilita();
	}

	function habilita(){
		$('#form_acidente').css("display", "block");
		$('.menu_central').css("display", "none");
	}
	function mostra_acidente(){
		$('#tipo').val("Acidente");
		habilita();
	}
	function volta(){
		$('#form_acidente').css("display", "none");
		$('.menu_central').css("display", "block");
	}
</script>

</html>