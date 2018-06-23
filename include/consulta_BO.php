<?php
	function mostra_dados($parametro, $input){
		//$sql = "SELECT tipo, "
		for ($i=0; $i <= 5; $i++) { 
			$numero_bo = 1231321;
			$status = "Enviado";
			echo '
				<tr> 
				  <td><p>'.$numero_bo.'</p></td>
				  <td style="text-align: center;"><p>'.date('d/m/y').'</p></td>
				  <td><a href="mostra_boletim.php?numero_bo='.$numero_bo.'"><button>Ver</button></a></td>
				  <td><p>'.$status.'</p></td>
				</tr>
			';
		}
	}
?>