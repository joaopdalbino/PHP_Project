<!DOCTYPE html>
<html>
<?php
	include "include/topo.php";
?>
<body>
	<div id="wrap">
		<?php include "include/menu.php"; ?>
		
		<div class ="menu_central">
			<button id="btn_acidente" onclick="mostra_acidente()"> ACIDENTE </button>
			<button id="btn_ocorrencia" onclick="mostra_ocorrencia()"> OCORRÊNCIA </button>
		</div>

	</div>
</body>

<script type="text/javascript">
	function mostra_ocorrencia(){
		$('#tipo').val("Ocorrencia");
		window.location.href = "emergencia.php?tipo=Ocorrência";
	}

	function mostra_acidente(){
		$('#tipo').val("Acidente");
		window.location.href = "emergencia.php?tipo=Acidente";
	}
</script>

</html>