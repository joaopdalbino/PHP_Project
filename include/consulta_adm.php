<?php
	function mostra_dados($perfil, $consulta, $tipo){
		if($perfil == "adm"){
			if($consulta == "geral_emergencias"){
				//$sql = "SELECT tipo, "
				for ($i=0; $i <= 5; $i++) { 
					if($i%2 == 0)
						$tipo = "Policia";
					else
						$tipo = "Ambulância";
					$id_emergencia = $i;
					$endereco = "Rubens Arruda, 19125";
					$status = "Enviado";
					echo '
						<tr> 
						  <td><p>'.$tipo.'</p></td>
						  <td style="text-align: center;"><p>'.date('d/m/y').'</p></td>
						  <td><p>'.$endereco.'</p></td>
						  <td><a href="mostra_boletim.php?id='.$id_emergencia.'&tipo='.$tipo.'"><button>Ver</button></a></td>
						  <td><p>'.$status.'</p></td>
						</tr>
					';
				}
			}
		}
	}
?>