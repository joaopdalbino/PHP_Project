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
		  	<h1>Dados Pessoais</h1>
		    <table border="0" cellspacing="0" cellpadding="0">
		      <tr>
		        <td>
		            <input name="nome" type="text" id="nome"placeholder="Nome" required>
		            <input name="CPF" type="text" id="CPF" placeholder="CPF" required>
		            <input name="RG" type="text" id="RG" placeholder="RG" required>
		            <input name="rua" type="text " id="rua" placeholder="Rua" required>
		            <input name="numero" type="text " id="numero" placeholder="Número" required>
		            <input name="bairro" type="text " id="bairro" placeholder="Bairro" required>
		            <input name="complemento" type="text " id="complemento" placeholder="Complemento">
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
		            <button name="confirma" onclick="mostrar_bo()" type="submit" id="confirma" value="Confirma">Confirmar</button>
		        </td>
		      </tr>
		    </table>
		  </form>
		</div>
		<!-- FORM PARA CADASTRO -->

		<!-- FORM PARA CADASTRO BO -->
		<div id="form_bo" class="formularios">
		  <form name="form2" id="form2" method="post" action="" enctype="text/plain">
		  	<h1>Boletim de Ocorrência</h1>
		    <table border="0" cellspacing="0" cellpadding="0">
		      <tr>
		        <td>
		            <select name="categoria">
		            	<option value="assedio_sexual">Assédio Sexual</option>
		            	<option value="assedio_moral">Assédio Moral</option>
		            </select>
		            <input type="date" name="data" id="data">
		            <input name="rua" type="text " id="rua" placeholder="Rua" required>
		            <input name="numero" type="text " id="numero" placeholder="Número" required>
		            <input name="bairro" type="text " id="bairro" placeholder="Bairro" required>
		            <input name="complemento" type="text " id="complemento" placeholder="Complemento">
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
		            <textarea name="boletim" id="boletim" rows="10" cols="50" placeholder="Digite aqui o B.O. Não deixe de descrever toda as questões."></textarea>
		            <button name="send" type="submit" id="send" value="Send">Salvar</button>
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
	$( document ).ready(function() {
	    $("#form_bo").css("display", "none");
	});
	function mostrar_bo(){
		$("#form_bo").css("display", "block");
	}

</script>
</html>