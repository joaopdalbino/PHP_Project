<!DOCTYPE html>
<html>
<?php
	include "include/db_conexoes.php";
	include "include/topo.php";
    session_start();
    if(isset($_POST["Entrar"])){
        $tipo = login($_POST['usuario'], $_POST['senha']);
    }else{
        $tipo = $_SESSION["tipo"];
    }

    if($tipo < 0){
        header("Location: index.php?erro=1");
    }
    if(isset($_GET["mensagem"])){
        if($_GET["mensagem"] == "ok"){?>
            <script type="text/javascript">
                alert("Dados Salvos!");
                window.location.href = 'administrativo.php';
            </script>
        <?php
        }
        if($_GET["mensagem"] == "erro"){
            ?>
            <script type="text/javascript">
                alert("Dados não foram salvos!");
                location.reload();
            </script>
        <?php
        }
    }
?>
<body>
	<div id="wrap">
		<?php include "include/menu_administrativo.php"; ?>
		
		<div class="tabs">
            <ul class="tab-links">
              <li <?php if($_SESSION["tipo"] != 'Administrador') echo "hidden"; ?> <?php if($_SESSION["tipo"] == 'Administrador') echo 'class="active"'; ?> ><a href="#tab1">Emergências Gerais</a></li>
              <li <?php if($_SESSION["tipo"] == 'Policia') echo "hidden"; ?> <?php if($_SESSION["tipo"] == 'Ambulancia') echo 'class="active"'; ?> ><a href="#tab2">Ambulância</a></li>
              <li <?php if($_SESSION["tipo"] == 'Ambulancia') echo "hidden"; ?> <?php if($_SESSION["tipo"] == 'Policia') echo 'class="active"'; ?> ><a href="#tab3">Polícia</a></li>
              <li <?php if($_SESSION["tipo"] == 'Ambulancia') echo "hidden"; ?> ><a href="#tab4">B.Os</a></li>
              <li <?php if($_SESSION["tipo"] != 'Administrador') echo "hidden"; ?> ><a href="#tab5">Configurações</a></li>
            </ul>

            <div class="tab-content">
                <?php if($_SESSION["tipo"] == 'Administrador'){

                 ?>
            	<div id="tab1" <?php if($_SESSION["tipo"] == 'Administrador') echo 'class="tab active"'; ?>>
            	  <div align=center>
            	    <h3>Emergências gerais</h3>
            	    <table class="tabusuario">     
            	      <tr>
            	        <th>Tipo</th>
            	        <th>Data</th>
            	        <th>Mais detalhes</th>
            	        <th>Status</th>
                        <th>Mudar Status</th>
            	      </tr>
            	      <?php Elenca_Emergencias(0); ?>
            	    </table>
            	   </div>
            	</div>
                <?php
                }
                ?>

                <?php if(($_SESSION["tipo"] == 'Ambulancia') || ($_SESSION["tipo"] == 'Administrador')){

                ?>
            	<div id="tab2" <?php if($_SESSION["tipo"] == 'Ambulancia'){echo 'class="tab active"';}else{echo 'class="tab"';} ?>>
            	  <div align=center>
            	    <h3>Ambulância</h3>
            	    <table class="tabusuario">     
                      <tr>
                        <th>Tipo</th>
                        <th>Data</th>
                        <th>Mais detalhes</th>
                        <th>Status</th>
                        <th>Mudar Status</th>
                      </tr>
                      <?php Elenca_Emergencias(1); ?>
                    </table>
            	   </div>
            	</div>
                <?php
                }
                ?>

                <?php if(($_SESSION["tipo"] == 'Policia') || ($_SESSION["tipo"] == 'Administrador')){

                ?>
            	<div id="tab3" <?php if($_SESSION["tipo"] == 'Policia'){echo 'class="tab active"';}else{echo 'class="tab"';} ?>>
            	  <div align=center>
            	    <h3>Polícia</h3>
            	    <table class="tabusuario">     
                      <tr>
                        <th>Tipo</th>
                        <th>Data</th>
                        <th>Mais detalhes</th>
                        <th>Status</th>
                        <th>Mudar Status</th>
                      </tr>
                      <?php Elenca_Emergencias(2); ?>
                    </table>
            	   </div>
            	</div>
                <?php
                    }
                ?>

                <?php if(($_SESSION["tipo"] == 'Administrador') || ($_SESSION["tipo"] == 'Policia')){

                 ?>
                <div id="tab4" class="tab">
                  <div align=center>
                    <h3>Boletins de Ocorrência</h3>
                    <table class="tabusuario">     
                      <tr>
                        <th>Número</th>
                        <th>Data</th>
                        <th>Mais detalhes</th>
                        <th>Status</th>
                        <th>Mudar Status</th>
                      </tr>
                      <?php Elenca_BO("geral", 0); ?>
                    </table>
                   </div>
                </div>
                <?php
                }
                ?>

                <?php if($_SESSION["tipo"] == 'Administrador'){

                ?>
                <div id="tab5" class="tab">
                    <div align=center>
                    <h3>Configurações</h3>
                    <form method="post" action="include/criar_usuario.php">
                        <table class="tabusuario">
                            <tr>
                                <td>
                                    <p>Número Registro: </p>
                                </td>
                                <td>
                                    <input name="registro" type="text" id="registro" placeholder="Nº Registro" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Senha: </p>
                                </td>
                                <td>
                                    <input name="senha" type="password" id="senha" placeholder="Senha" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Tipo de usuário: </p>
                                </td>
                                <td>
                                    <select name="tipo">
                                        <option value="Administrador">Administrador</option>
                                        <option value="Ambulancia">Ambulancia</option>
                                        <option value="Policia">Policia</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><p>Clique em salvar:</p></td>
                                <td><button name="send" type="submit">Criar</button></td>
                            </tr>
                        </table>
                    </form>
                    </div>
                </div>
                <?php
                }
                ?>
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