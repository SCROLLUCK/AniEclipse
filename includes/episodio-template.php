<?php
    session_start();
    $target="episodio-template.php";
    if(basename($_SERVER["PHP_SELF"])== $target){
        die("<meta charset='utf-8'><title></title><script>window.location=('../index.php')</script>");
    }

    $tipoObra = "";
    if($_SERVER["PHP_SELF"] == "/animes/index.php"){
        $tipoObra = "animes";
    }else if($_SERVER["PHP_SELF"] == "/animacoes/index.php"){
		$tipoObra = "animacoes";
	}

    include("../../class/Anime.php");
    include("../../class/Animacao.php");
    include("../../class/Usuario.php");
    include("../../class/Episodio.php");

    include("../../controllers/episodios.php");
  
    $numeroEpisodio;
    $numeroOva;
    
    $episodioVisto;
    $ovaVisto;

    $obraVista;
	$tipoObra == "animes" ? $obraVista = new Anime() : $obraVista = new Animacao();
	
	$obraVista->id = $id;
	
	$tipoObra == "animes" ? $obraVista->fillAnime('naoUsuario') : $obraVista->fillAnimacao('naoUsuario');

    $numeroEpisodios = $obraVista->episodiosUpados();

    $listaEpisodiosPraAssistir;

    if(isset($_GET['ep'])) {
        $label = "EP.";
        $numeroEpisodio = $_GET['ep'];

        $listaEpisodiosPraAssistir = listarEpisodiosAssistir($numeroEpisodio,$obraVista->id);

        $episodioVisto = new Episodio();
        $episodioVisto->obra = $obraVista;
        $episodioVisto->carregaEpisodio($numeroEpisodio);
        $episodioVisto->fillEpisodio();

        $antdis = "block";
        $proxdis = "block";
        if($ep == 1) {
            $antdis = "none";
        }

        if($ep == $numeroEpisodios) {
            $proxdis = "none";
        }
    }
    
    if(isset($_GET['ova'])) {
        
    }
  
  $titlePagina = $obraVista->nome." - Episódio ".$numeroEpisodio;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <?php include("../../includes/head.php"); ?>

    <link rel="stylesheet" type="text/css" href="../../css/novo-episodio.css">
    <link rel="stylesheet" type="text/css" href="../../css/player.css">
    <script src="../../js/player2.js"></script>
    <script src="../../js/episodioObra.js"></script>
    <script type='text/javascript'>

        $(document).ready(function() {
            $('video').videoPlayer({
                'playerWidth' : 0.95,
                'videoClass' : 'video'	
            });
        });


    </script>

    <style>
        #loading {
            display: none;
        }
    </style>
  
    <body class="body" style=" background: url(img/<?=$obraVista->background?>); background-size: 100%;">
    <?php include("../../includes/menu.php");?>
    
    <div class="SUB">
    <div class="CENTER">
        <div class="conteiner" id="conteiner" onmouseover="javascript:start();" onmousemove="javascript:selectPlayer(this);" ondblclick="expandPlayer();">
        <div class="lds-css ng-scope" id="loading"><div class="lds-eclipse"><div></div></div></div>  
        <div class="CONT-EPISODIO">
          <h2 class="NAME-ANIME" id="NOMEA"> <?=strtoupper($obraVista->nome)?>
            <p class="NAME-EPISODIO"><?=$label?> <?=$numeroEpisodio?> - <?=$episodioVisto->nome?></p>
          </h2>
        </div>
                <!-- VÍDEO -->
                <video id="VIDEO" src="<?=$episodioVisto->nomeArquivo?>" poster="img/<?=$episodioVisto->thumb?>" preload="auto" type="video/mp4">
    
                </video>
 
        </div>
        <div class="INFO-EPISODIO">
          <div class="THUMB-EPISODIO">

                <div class="thumb-EPISODIO" style="position:relative;">
                    
                    <p class="tempo" style="left: 0%; right: inherit;"><?=$episodioVisto->duracao?></p>
                    <?php if($numeroEpisodio == $numeroEpisodios){ ?>
                        <p class="final" style="left: 55px; right: initial;">FINAL</p>
                    <?php } ?>
                    <a class="link-logo" href="../../<?=$obraVista->diretorio?>" title="<?=$obraVista->nome?>" style="bottom: 3%">
                         <img class="logo-anime" src="img/logo.png" style="max-height: 93px; max-width: 93px;">
                    </a>
                    <p class="qualidade_EPISODIO" style="right: 10px;"><?=$episodioVisto->qualidadeMax?></p>
                    <p class="temporada_EPISODIO"><?=$episodioVisto->temporada?> Temporada</p>
                    <img class="THUMB-EGO" src="img/<?=$episodioVisto->thumb?>" style="width: 100%;image-rendering: -webkit-optimize-contrast;">
                  </div>
          </div>
        </div>
        
        <?php
            if($numeroEpisodio != $numeroEpisodios){
        ?>
        <div class="painelBotoesEp">
            <a href="episodio.php?ep=<?=$numeroEpisodio+1?>" class="botaoAnie">Próximo</a>
        </div>
        <?php
            }
        ?>
    
    </div> 
    <script>loop();</script>
    <ul class = "ListaUltimosEpisodios">
        <?php

            if($numeroEpisodios >= 2) {                    
                                
                foreach($listaEpisodiosPraAssistir as $epAssistir){
        ?>
                    <div class="EP LANCA">
                        <p class="tempo"><?=$epAssistir->duracao?></p>
                        <p class="temporadaInfo" style="display:none;"><?=$epAssistir->temporada?> Temporada </p>
                        <a class="LINK-EP" href="episodio.php?ep=<?=$epAssistir->numero?>" title="<?=$epAssistir->nome?>"></a>
                        <img class="THUMB" src="img/<?=$epAssistir->thumb?>">
                        <div class="identifica" style="width: 100%">
                            <a class="link-logo" href="../../<?=$epAssistir->obra->diretorio?>" title="<?=$epAssistir->obra->nome?>">
                                <img class="logo-anime" src="img/logo.png">
                            </a>
                            <a href="episodio.php?ep=<?=$epAssistir->numero?>">
                                <?php $EP_OU_OVA = "EPISODIO";
                                    if(isset($_GET['ova'])){
                                        $EP_OU_OVA = "OVA";
                                    }
                                ?>
                                <p class="episodio"><?=$EP_OU_OVA?> <?=$epAssistir->numero?></p>
                                <p class="anime"><?=strtoupper($epAssistir->obra->nome)?></p>
                                <p class="nomeEP"><?=$epAssistir->nome?></p>
                            </a>
                        </div>
                    </div>
        <?php
            }
        }
        ?>
    </ul>
    </div>
    <script src="../../js/complemento-player.js"></script>
    </body>
</html>