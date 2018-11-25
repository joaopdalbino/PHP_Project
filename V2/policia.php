<!DOCTYPE html>
<html>
<?php
	include "include/topo.php";
?>
<body>
	<div id="wrap">
		<?php include "include/menu.php"; ?>
		
		<div class ="menu_central">
			<button id="btn_furto" onclick="mostra_furto()"> Furto </button>
			<button id="btn_roubo" onclick="mostra_roubo()"> Roubo </button>
			<button id="btn_agressao" onclick="mostra_agressao()"> Agressão </button>
		</div>

	</div>
</body>

<script type="text/javascript">
	function mostra_furto(){
		$('#tipo').val("Furto");
		window.location.href = "emergencia.php?tipo=Furto"; 
	}

	function mostra_roubo(){
		$('#tipo').val("Roubo");
		window.location.href = "emergencia.php?tipo=Roubo"; 
	}

	function mostra_agressao(){
		$('#tipo').val("Agressão");
		window.location.href = "emergencia.php?tipo=Agressão"; 
	}
</script>

</html>