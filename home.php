<?php session_start(); ?>
<!DOCTYPE html>
<html>
	
	<?php 
		$titlePagina = "Ani Eclipse - Dimensão Otaku"; 
		include("includes/head.php");
	?>
	<link rel="stylesheet" type="text/css" href="css/teste.css">

	<body class="body parallax" data-speed="6" style="background-position: 50% 0px; background: url('img/kaneki.jpg'); position: relative; float: left; width: 100%;background-size:100%;" onload="main(); atualizaDatas();">
		
		<?php include("includes/menu.php");?>
		
		<div class="sub" onclick="LimpaBuffer();">
      
		<div class="CENTER">
			<div class="TEMPORADAS">
				<div class="titulo-controle">
					<p class="ICO DIA" id="pRecentes" onclick="exibe('recentes');">Recentes <input type="button" value="hoje" class="INP-Controll"/></p>
					<p class="ICO DIA" id="pAnimes" onclick="exibe('animes');">
						Lançamentos
						<input type="button" value="recente" class="INP-Controll"/>
					</p>
				</div>
				
				<div class="SLIDE-HORIZONTAL" id="box">
					<div class="lds-css ng-scope"><div style="position: relative; float: left; left: 50%; transform: translateX(-50%);" class="lds-eclipse"><div></div></div></div>
			</div>
		</div>
		
		</div>
	</div>
		
	</div>
		<script>loop();</script>

	<div class="ANIMACOES">
    <div class="GuiaDeNavegacao">
		<p class="OpcaoGuia" onClick="exibirLista('recentes');"><span class="OP-span">Adicionados</span></p>
		<p class="OpcaoGuia" onClick="exibirLista('lancamentos');" ><span class="OP-span">Lançamentos</span></p>
		<p class="OpcaoGuia" onClick="exibirLista('animacoes');"><span class="OP-span">Animações</span></p>
	</div>
		<div class="ESCONDE-SCROLLS">
		<ul class="ListaANIMACOES" id="LISTA">
		<div class="lds-css ng-scope"><div style="position: relative; float: left; left: 50%; transform: translateX(-50%);" class="lds-eclipse"><div></div></div></div>
		</ul>
		</div>
	</div>

	<!--LIB AXIOS-->
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/homeAjax.js"></script>
</body>
</html>