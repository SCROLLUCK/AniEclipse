<?php
	session_start();
	$target="obra-template.php";
	if(basename($_SERVER["PHP_SELF"])== $target){
		die("<meta charset='utf-8'><title></title><script>window.location=('../index.php')</script>");
	}

	$tipoObra = "";
	$roteirista;
    if( strpos($_SERVER["PHP_SELF"], "animes") !== false){
		$tipoObra = "animes";
		$roteirista = "Mangaká";
    }else if( strpos($_SERVER["PHP_SELF"], "animacoes") !== false){
		$tipoObra = "animacoes";
		$roteirista = "Autor(es)";
	}

	include("../../class/Usuario.php"); 
	include("../../class/Anime.php");
	include("../../class/Animacao.php");
	include("../../class/Episodio.php");
	include("../../class/Genero.php");

	$obraVista;
	$tipoObra == "animes" ? $obraVista = new Anime() : $obraVista = new Animacao();
	
	$obraVista->id = $id;
	
	$tipoObra == "animes" ? $obraVista->fillAnime('naoUsuario') : $obraVista->fillAnimacao('naoUsuario');

	$obraVista->fillTemporadas($tipoObra);

	$listaGenerosAnime = $obraVista->listarGeneros();

	$listaTemporadas = $obraVista->listarTemporadas();

	$epsUpados = $obraVista->episodiosUpados();

	$titlePagina = $obraVista->nome." - Ani Eclipse";

	$multiplatemp = 0;
	if(empty($obraVista->temporadaAtual)){
		$multiplatemp = 1;
	}

?>
<!DOCTYPE html>
<html>
    <?php include("../../includes/head.php"); ?>
    <link rel="stylesheet" type="text/css" href="../../css/perfil.css">
    <link rel="stylesheet" type="text/css" href="../../css/novo-index.css">

  <body onload="exibirEpisodios(<?=$obraVista->id?>,'<?=$obraVista->diretorio?>',<?=$multiplatemp?>);">
	<?php include("../../includes/menu.php");?>
	<div class="parallax" data-speed="6" id="home" style="background-position: 50% 0px; background: url(http://localhost:8080/<?=$obraVista->diretorio?>/img/<?=$obraVista->background?>); position: relative; float: left; width: 100%;background-size:100%;">
		<div id="info-anime">
		    <div class="ENGLOBAL">
		        <div class="COMP-LOGO"><img class="LOGO_ANIME" src="http://localhost:8080/<?=$obraVista->diretorio?>/img/logo.png"></div>
			</div>
			<div class="INFO">
              
       			<?php if($obraVista->temporadaAnterior != NULL){ ?>
                  <div class="seta ant">
                    	<i class="fa fa-angle-left SETA-ico" style="font-size:44px;"></i>
                        <div class="O-temporada O-ant">
						<p class="meioObvio" style="right: initial; left: 3px;">Temporada Anterior</p>
                            <div class="white-space-4"></div>
                            <a class="link-temporada" href="../../<?=$obraVista->temporadaAnterior->diretorio?>" title="<?=$obraVista->temporadaAnterior->nome?>"></a>
                            <img class="capa" src="../../<?=$obraVista->temporadaAnterior->diretorio?>/img/<?=$obraVista->temporadaAnterior->capa?>">
                        </div>
                    </div>
              	<?php } ?>
              
              	<?php if($obraVista->temporadaPosterior != NULL){ ?>
            	<div class="seta prox">
                  	<i class="fa fa-angle-right SETA-ico" style="font-size:44px;"></i>
					<div class="O-temporada O-prox">
					<p class="meioObvio">Próxima Temporada</p>
						<div class="white-space-5"></div>
						<a class="link-temporada" href="../../<?=$obraVista->temporadaPosterior->diretorio?>" title="<?=$obraVista->temporadaPosterior->nome?>"></a>
                        <img class="capa" src="../../<?=$obraVista->temporadaPosterior->diretorio?>/img/<?=$obraVista->temporadaPosterior->capa?>">
	            	</div>
            	</div>
              	<?php } ?>
              
			<div class="CENTER">
			<button class="but" onclick="mostra(1);" ><i class="fa fa-info-circle" aria-hidden="true"></i></button>
			<button class="but but2" onclick="mostra(2);" ><i class="fa fa-film" aria-hidden="true"></i></button>
    			<div class="temporadaAtual">
    				<img class="capa" src="http://localhost:8080/<?=$obraVista->diretorio?>/img/<?=$obraVista->capa?>">
					<?php
						if( !empty($obraVista->temporadaAtual) ){ 
					?>
    				<div class="temporada-Info"><?=$obraVista->temporadaAtual?>ª Temporada</div>
					<?php
						}
					?>
    			</div>
    			<h1 id="nome-anime"><?=$obraVista->nome?></h1>
    			<div class="Info-anime" style="right: 0%;">
    					<div class="cap-conveniente">
    						<div class="info-visual" style="z-index: 1;">
    							<p class="faixa"><?=$obraVista->idade?></p>
    							<a href="../../perfil.php?id=<?=$obraVista->uploader->id?>" title="<?=$obraVista->uploader->nickname?>" ><div class="responsavel" style="background:url(../../<?=$obraVista->uploader->perfil?>);background-size:cover;background-position-x:center;"></div></a>
    						</div>
							<div id="CONTENT-INFO">
							<?php
  								$NomeAlt = "Desconhecido";
  								if($obraVista->nomeAlternativo != "") { $NomeAlt = $obraVista->nomeAlternativo;}
                            	echo "<p class='info'><span class='name-info'>Título Alternativo:</span> $NomeAlt</p>";
                      	    ?>
							<p class="info"> <span class="name-info">Estreia:</span> <?=$obraVista->estreia?></p>
                            <p class='info'>
				<span class="name-info GG">Gêneros:</span>
				<?php
					foreach($listaGenerosAnime as $gen){
				?>
				<a class="linkAnimes" href="http://localhost:8080/animes/?gen=<?=$gen->id?>"><?=$gen->nome?></a>
				<?php
					}
				?>
			    </p>
							<p class="info"><span class="name-info"><?=$roteirista?>:</span> <?=$obraVista->roteirista?></p>		
							<p class="info"> <span class="name-info">Estudio:</span> <?=$obraVista->estudio?></p>
							<p class="info"> <span class="name-info">Status:</span> <?=$obraVista->status?></p>
							<p class="info"> <span class="name-info">Transmissão:</span> <?=$obraVista->transmissao?></p>
							<p class="info"> <span class="name-info">Qualidade:</span> <?=$obraVista->qualidadeMax?></p>
							<?php
								if($tipoObra == "animes"){ 
							?>
							<p class="info"> <span class="name-info">OVAs:</span> <?=$obraVista->numeroOvas?></p>
							<?php
								}
							?>
							<p class="info"> <span class="name-info">Temporadas:</span> <?=$obraVista->numeroTemporadas?></p>
							<p class="info"> <span class="name-info">Episódios:</span> [<?=$epsUpados?>/<?=$obraVista->numeroEpisodios?>]</p>
                          	<p class="info"> <span class="name-info">Site Oficial: </span>
                          	<?php
  								if($obraVista->site != "") { 
                                  	$site = $obraVista->site;
                            		echo "<a target='_blank' style='color: #00bfff; text-decoration:none;' href='$site'> $site</a>";
                                }else { echo "Desconhecido";}
                      	    ?>
                      	</div>
                      	<iframe id="CONTENT-TRAILLER" style="width: 100%; height: 440px; display: none;" src="<?=$obraVista->trailler?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
						</div>
				</div>
				<p class="Sinopse"><span class="name-info" >Sinopse: </span><?=$obraVista->sinopse?></p>
              </div>
			</div>
		</div>
	
	<div id="EPS" class="parallax" data-speed="3" style="background-position: 50% 0px;">
		
		<div class="navOP">
        	<div class="tituloOP">
        		<p class="OP_nav">EPISÓDIOS</p><input type="button" value="episodiosanimes-<?=$IDAnimeAtual?>" class="INP-ControllPerfil">
        	</div>
			<?php
				if($tipoObra == "animes"){
			?>
			<div class="tituloOP">
				<p class="OP_nav">OVAS</p><input type="button" value="ovasanimes-<?=$IDAnimeAtual?>" class="INP-ControllPerfil">
			</div>
			<?php
				}
			?>
			<div class="tituloOP">
				<p class="OP_nav">FILMES</p><input type="button" value="filmesanimes-<?=$IDAnimeAtual?>" class="INP-ControllPerfil">
			</div>
			<div class="temporadas">
				<?php
					if($multiplatemp){
						foreach($listaTemporadas as $temp){
				?>
						<div class="tituloOP">
							<p class="OP_nav OP_temp"><?=$temp[0]?>ª Temporada</p><input type="button" onclick="exibePorTemporada(<?=$id?>,<?=$temp[0]?>);" class="INP-ControllPerfil">
						</div>
				<?php
						}
					}
				?>
			</div>
		</div>

		<ul class="EPISODIOS" style="max-width:100%;" id="listaVideos"></ul>

	</div>
	
	<!--LIB AXIOS-->
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

	<script type="text/javascript" src="../../js/indexObra.js"></script>
	
	</div>
</body>
</html>