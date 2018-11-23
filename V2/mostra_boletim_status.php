<!DOCTYPE html>
<html>
<?php
	include "include/db_conexoes.php";
	include "include/topo.php";
	if(isset($_POST['parametro']))
		$parametro = $_POST['parametro'];
?>
<body>
	<div id="wrap">
		<?php include "include/menu.php"; ?>
		<div class="tab-content">
			<div id="tab1" class="tab active">
			  <div align=center>
			    <h3>Emergências gerais</h3>
			    <table class="tabusuario">     
			      <tr>
			        <th>Numero BO</th>
			        <th>Data </th>
			        <th>Mais detalhes</th>
			        <th>Status</th>
			      </tr>
			      <?php Elenca_BO($parametro, $_POST["dado"]); ?>
			    </table>
			   </div>
			</div>
		</div>
	</div>
</body>
</html>