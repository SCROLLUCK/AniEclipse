<?php
  session_start();
  require_once("class/Usuario.php"); 
?>
<!DOCTYPE html>
<html>
  <?php

    if(!isset($_GET['id'])){
      echo "<meta http-equiv='refresh' content='0,url=../'>";
    }

    $usuarioVisto = new Usuario();
    $usuarioVisto->id = $_GET['id'];
    $usuarioVisto->fillUsuario();

    $usuarioLogado = new Usuario();
    $usuarioLogado->id = $_SESSION['usuarioLogado'];

    $mesmoUsuario;

    $usuarioLogado->id == $usuarioVisto->id ? $mesmoUsuario = TRUE : $mesmoUsuario = FALSE;

    if($usuarioVisto->nickname == null){
      echo "<meta http-equiv='refresh' content='0,url=../'>";
    }

    $tagUploader;
    if($usuarioVisto->uploader == 1){
      $tagUploader = "<p class='UPLOADER'>UPLOADER</p>";
      
      $EpsUpados = $usuarioVisto->numeroEpisodiosUpados();

      $AnimesContribuidos = $usuarioVisto->numeroAnimesResponsavel();
    }
    
    $titlePagina = $usuarioVisto->nickname." - Ani Eclipse";
    include("includes/head.php");
  ?>

  <link rel="stylesheet" type="text/css" href="css/perfil.css">

	<body style=" background: #191818;">
    <?php 
      include("includes/menu.php");
    ?>
	    <div class="Capa-User" style="background: url(<?=$usuarioVisto->background?>); background-size:100%; background-position-y: -116px;">
	        <div class="Info-User">
              	<div class="caixa-style">

                    <p class="NICK"><?=$usuarioVisto->nickname?></p>
                    <?=$tagUploader?>              

                 </div>

                 <?php
                  if(!$mesmoUsuario){
                 ?>
                    <label for="userfile" class="foto-user-static TERCEIRO" style="background: url(<?=$usuarioVisto->perfil?>); background-position-x: center; background-size: cover;"></label>
                    
                    <?php
                      if($usuarioLogado->id){

                        if(!$usuarioLogado->jaCurtiu($usuarioVisto)){
                    ?>
                    <form method="post" action="controllers/usuarios.php" class="contentCurtir">
                      <input type="hidden" name="op" value="like">
                      <input type="hidden" name="curtiu" value="<?=$usuarioLogado->id?>">
                      <input type="hidden" name="curtido" value="<?=$usuarioVisto->id?>">
                      <i class="fas fa-thumbs-up" style="position: absolute; left: 14%; top: 20%;"></i>
                      <input type="submit" class="btnCurtir" value="Curtir">
                    </form>
                 <?php
                        }else {

                          ?>
                          <div class="contentCurtir">
                            <i class="fas fa-thumbs-up" style="position: absolute; left: 14%; top: 20%;"></i>
                            <button class="btnCurtir">Curtido</button>
                          </div>
                          <?php

                        }
                      }
                  }
                 ?>

                <div class="Info-plus-User">

                    <?php
                      if($mesmoUsuario){
                    ?>

                    <form action="controllers/usuarios.php" method="post" enctype="multipart/form-data">
                    <div class="hoverLabel" style="background: url(<?=$usuarioVisto->perfil?>); background-position-x: center; background-size: cover;">
                      <label for="userfile" class="foto-user" >
                        <i class="fas fa-camera ICOcamera"></i>
                        <p class="descri">Trocar foto</p>
                        <input required type="file" name="userFoto" id="userfile" accept="image/*" onchange="verificaFoto()">
                        <input type="hidden" name="op" value="updatephoto">
                      </label>
                    </div>
                    <button type="submit" class="botaoUpFoto">Salvar</button>
                    </form>

                    <?php
                      }
                    ?>

	          		<p style=" padding-left: 12px; "><i class="fas fa-user"></i> Nome: <?=$usuarioVisto->nome?></p>
	                <p style=" padding-left: 18px; "><i class="fas fa-envelope"></i> E-mail: <?=$usuarioVisto->email?></p>
	                <p style=" padding-left: 23px; "><i class="fas fa-heart"></i> Curtidas: <?=$usuarioVisto->curtidas?></p>
	                <?php 
  					        if($usuarioVisto->uploader == 1) { 
                  	?>
                  	<p style="padding-left: 26px;">Episódios upados: <?=$EpsUpados?></p>
                  	<p style="padding-left: 14px;">Animes em que contribuiu: <?=$AnimesContribuidos?></p>
                  	<?php
                    }                   
                   	?>

                </div>      
            </div>
      </div>
    <script src="js/perfil.js"></script>
	</body>
</html>