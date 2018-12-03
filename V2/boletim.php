<!DOCTYPE html>
<html>
<?php
	include "include/topo.php";
	$enviado = $_POST["send"];
	if ($enviado != ""){
	    include "include/db_conexoes.php";
	    $var = [
			'cpf' => $_POST["CPF"],
			'nome' => $_POST["nome"],
			'tipo' => $_POST["categoria"],
			'logradouro' => $_POST["logradouro"],
			'numero' => $_POST["numero"],
			'bairro' => $_POST["bairro"],
			'complemento' => $_POST["complemento"],
			'cidade' => $_POST["cidade"],
			'estado' => $_POST["estado"],
			'boletim' => $_POST["boletim"],
			'rg' => $_POST["RG"],
			'telefone' => $_POST["telefone"],
			'desc' => $_POST["boletim"],
			'data' => $_POST["data"]
		];
	    Insere_BO($var);
	}
?>
<body>
	<div id="wrap">
		<?php include "include/menu.php"; ?>

		<!-- FORM PARA CADASTRO BO -->
		<div id="form_bo" class="formularios">
		  <form name="form2" id="form2" method="post" action="">
		  	<h1>Boletim de Ocorrência</h1>
		    <table border="0" cellspacing="0" cellpadding="0">
		      <tr>
		        <td>
		        	<input name="nome" maxlength="140" type="text" id="nome" placeholder="Nome" required>
		        	<input name="CPF" maxlength="11" type="text" id="CPF" placeholder="CPF" required>
		            <input name="RG" maxlength="10" type="text" id="RG" placeholder="RG" required>
		            <input name="telefone" maxlength="13" type="text" id="telefone" placeholder="Telefone" required>
		            <select name="categoria">
		            	<option value="Assédio Sexual">Assédio Sexual</option>
		            	<option value="Assédio Moral">Assédio Moral</option>
		            	<option value="Roubo">Roubo</option>
		            	<option value="Furto">Furto</option>
		            </select>
		            <input type="date" name="data" id="data" required>
		            <input name="logradouro" maxlength="140" type="text" id="logradouro" placeholder="Logradouro" required>
		            <input name="numero" maxlength="10" type="text" id="numero" placeholder="Número" required>
		            <input name="cidade" maxlength="140" type="text" id="cidade" placeholder="Cidade" required>
		            <input name="bairro" maxlength="140" type="text" id="bairro" placeholder="Bairro" required>
		            <input name="complemento" maxlength="140" type="text" id="complemento" placeholder="Complemento">
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
		            <textarea name="boletim" id="boletim" rows="10" cols="50" required placeholder="Digite aqui o B.O. Não deixe de descrever toda as questões."></textarea>
		            <button name="send" type="submit" value="envio">Salvar</button>
		            <button name="reset" type="reset" value="Reset">Limpar</button>
		        </td>
		      </tr>
		    </table>
		  </form>
		</div>
		<!-- FORM PARA CADASTRO -->

	</div>
</body>
<script>
	$(document).ready(function() {
	    $("#numero").keydown(function (e) {
	        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
	            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
	            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
	            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
	            (e.keyCode >= 35 && e.keyCode <= 39)) {
	                 return;
	        }
	        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
	            e.preventDefault();
	        }
	    });

	    $("#telefone").keydown(function (e) {
	        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
	            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
	            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
	            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
	            (e.keyCode >= 35 && e.keyCode <= 39)) {
	                 return;
	        }
	        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
	            e.preventDefault();
	        }
	    });
	});
</script>
</html>