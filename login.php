<!DOCTYPE html>
<html>
<?php
	include "include/topo.php";
?>
<body>
	<div id="wrap">
		<?php include "include/menu.php"; ?>
		<div class ="menu_central">
			<!-- FORM LOGIN -->
			        <div id="login-form">

			          <form name="form1" method="post" action="administrativo.php">
			            <table border="0" cellspacing="0" cellpadding="0">
			              <tr>
			                <td>
			                    <h1>Acesse</h1>
			                    <input name="usuario" type="text" id="usuario" placeholder="Usuário">
			                    <input name="senha" type="password" id="senha" placeholder="Senha">
			                    <button name="Entrar" id="Entrar" type="submit" value="Entrar">Entrar</button>
			                </td>
			              </tr>
			            </table>
			          </form>
			          
			        </div>
			        <!-- FORM LOGIN -->
		</div>
	</div>
</body>

</html>