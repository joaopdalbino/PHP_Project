<!DOCTYPE html>
<html>
<?php
	include "include/db.php";
	include "include/topo.php";
	include "include/consulta_adm.php";
	$perfil = "adm";
?>
<body>
	<div id="wrap">
		<?php include "include/menu_administrativo.php"; ?>
		
		<div class="tabs">
            <ul class="tab-links">
              <li class="active"><a href="#tab1">Emergências Gerais</a></li>
              <li><a href="#tab2">Ambulância</a></li>
              <li><a href="#tab3">Polícia</a></li>
              <li><a href="#tab4">B.Os</a></li>
              <li><a href="#tab5">Estatísticas</a></li>
              <li><a href="#tab6">Configurações</a></li>
            </ul>

            <div class="tab-content">
            	<div id="tab1" class="tab active">
            	  <div align=center>
            	    <h3>Emergências gerais</h3>
            	    <table class="tabusuario">     
            	      <tr>
            	        <th>Tipo</th>
            	        <th>Data</th>
            	        <th>Endereço</th>
            	        <th>Mais detalhes</th>
            	        <th>Status</th>
            	      </tr>
            	      <?php mostra_dados($, "emergencia"); ?>
            	    </table>
            	   </div>
            	</div>

            	<div id="tab2" class="tab">
            	  <div align=center>
            	    <h3>Ambulância</h3>
            	    
            	   </div>
            	</div>

            	<div id="tab3" class="tab">
            	  <div align=center>
            	    <h3>Polícia</h3>
            	    
            	   </div>
            	</div>
           	</div>
        </div>
        <!-- FORM PARA CADASTRO -->
		<div id="overlay"></div>		
	</div>
</body>
<script type="text/javascript">
	
	jQuery(document).ready(function() {
	    jQuery('.tabs .tab-links a').on('click', function(e)  {
	        var currentAttrValue = jQuery(this).attr('href');	 
	        jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
	 	    jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
	        e.preventDefault();
	    });
	});
</script>
</html>