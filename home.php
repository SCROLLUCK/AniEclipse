<!DOCTYPE html>
<html>
	<head>
		<link rel="icon" href="img/logo-negra.png" type="image/x-icon" />
		<link rel="shortcut icon" href="img/logo-negra.png" type="image/x-icon" />
		<title> Ani Eclipse - Dimensão Otaku </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
                <link rel="stylesheet" type="text/css" href="css/estilo.css" />
		<link rel="stylesheet" type="text/css" href="css/home.css" />
		<link rel="stylesheet" href="css/home-mobile.css" media="(max-width: 480px)"/>
      	<link rel="stylesheet" type="text/css" href="css/menu.css" />
      	<link rel="stylesheet" href="css/menu-mobile.css" media="(max-width: 480px)"/>
        <link rel="stylesheet" type="text/css" href="css/reset.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
      	<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/jquery.js"></script>
		<script type="text/javascript" src="js/controllerHome.js"></script>
	</head>

	<body class="body parallax" data-speed="6" style="background-position: 50% 0px;" onload="temporadaAtual();">
		<?php
			include("menu.php");
		?>
		<div class="sub" onclick="LimpaBuffer();">
      
		<div class="CENTER">
			<div class="TEMPORADAS">
				<div class="titulo-controle">

					<p class="ICO TP" onclick="exibe(0,1);" >TP <input type="button" title="TEMPORADA PASSADA" value="passada" class="INP-Controll"/></p>
					<p class="ICO TA" onclick="exibe(1,1);" style="display: none;">TA <input type="button" title="TEMPORADA ATUAL" value="atual" class="INP-Controll"/></p>
					<p class="ICO DIA" onclick="exibe(2,1);">Todos <input type="button" value="hoje" class="INP-Controll"/></p>
					<p class="SUBICO" onclick="exibe(3,1);">
						<input type="button" title="ANIMAÇÕES" value="animacoes" class="INP-Controll"/>
						<i class="fa fa-rocket" aria-hidden="true"></i>
					</p>
					<p class="SUBICO" onclick="exibe(4,1);">
						<input type="button" title="OVAS" value="ovas" class="INP-Controll"/>
						<i class="fa fa-forumbee" aria-hidden="true"></i>
					</p>
					<p class="SUBICO" onclick="exibe(5,1);">
						<input type="button" title="RECENTEMENTE ADICIONADOS" value="recente" class="INP-Controll"/>
						<i class="fa fa-list-ul" aria-hidden="true"></i>
					</p>
					
					<p class="ICO UV" style="background: url("DiretorioDafotoDoUsuario"); width: 40px; height: 40px; border-radius: 50%; background-size: cover; background-position: center center; float: left; margin: 9px 0;" onclick="exibe(6,1);"><input type="button" title="Ultimos Vistos" value="ultimosVistos" class="INP-Controll"></p>
				

					<p class="title-barra" style="display: none;">TEMPORADA PASSADA</p>
					<p class="title-barra">ÚLTIMOS EPISODIOS LANÇADOS</p>
					<p class="title-barra" style="display: none;">EPISODIOS DO DIA</p>
					<p class="title-barra" style="display: none;">ANIMAÇÕES</p>
					<p class="title-barra" style="display: none;">OVAS</p>
					<p class="title-barra" style="display: none;">RECENTEMENTE ADICIONADOS</p>
					<p class="title-barra" style="display: none;">ÚLTIMOS VISTOS</p>

				</div>
				
				<div class="SLIDE-HORIZONTAL" id="box">
					<img src="img/loading.gif" style="position: relative; float: left; width: 300px; left: 50%; transform: translateX(-50%);">
			</div>
		</div>
		
		</div>
	</div>
		
	</div>
	<div class="Obras">
		<div class="OBRAS-add">
			<div class="ANIMES">
				<div class="show-OBRA">
				    <ul class="OBRAS-lista" id="LISTA" data-hover="false">
				              
					    <div class="OBRA-show" style="background: url("DiretorioDOBackground"); background-size: cover;">
					    <div class="sombra">
					       <div class="CENTER-sombra">
					    	<div class="ABAS">
								<p class="OP-ABA">VISÃO GERAL</p>
								<p class="OP-ABA">TRAILLER</p>
							    <p class="OP-ABA">EPISODIOS</p>
							    <p class="OP-ABA">ANIMES SEMELHANTES</p>         
							</div>
						    <div class="info-OBRA parallax" data-speed="6" style="background-position: 50% -160.333px; background: url("DiretorioDaCApaDoAnime"); background-size: 100%;"></div>
						    <div class="info-OBRA-plus">
							    <div class="info-OBRA-OP">
							    <h1 class="nome-OBRA"><p class="TITULO-OBRA">ANIME </p> Nome do Anime</h1>
							    <p class="temporada">2019 (numeroDatemporada 2)ª Temporada <span class="idade"> 17</span></p>
							    <p class="sinopse-OBRA">Sinopse do anime</p>
							    <a href="diretorioDoAnime" class="add-favorito"> <i class="fas fa-tv" aria-hidden="true"></i> Assistir! </a>
							</div>
							</div>
						  </div>
						</div>
					</div>
				</ul>
					<script>slideOBRAS();</script>
				</div>
			</div>
			
		<script>loop();</script>
</body>
</html>