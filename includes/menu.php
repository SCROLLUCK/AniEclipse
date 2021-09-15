<?php 
	$pathServer = "/home/storage/c/29/18/anieclipse3/public_html/";
	$pathDocker = "/home/lse/REPOS/AnieEclipse";

    if(file_exists($pathServer)){
		include($pathServer."/controllers/generos.php");
		require_once($pathServer."/class/Usuario.php");
    }else {
        include($pathDocker."/controllers/generos.php");
		require_once($pathDocker."/class/Usuario.php");
    }

	$listaGeneros = listarGeneros();
?>
<script type="text/javascript" src="../../js/busca.js"></script>
<script type="text/javascript" src="../../js/menu.js"></script>
<script>

			var qTipTag = new Array("a", "abbr", "acronym");
				var qTipX = -30;
				var qTipY = 25;

				tooltip = {
					name : "qTip",
					offsetX : qTipX,
					offsetY : qTipY,
					tip : null
				}

				tooltip.init = function () {
					var tipNameSpaceURI = "http://www.w3.org/1999/xhtml";
					if(!tipContainerID){ var tipContainerID = "qTip";}
					var tipContainer = document.getElementById(tipContainerID);

					if(!tipContainer) {
						tipContainer = document.createElementNS ? document.createElementNS(tipNameSpaceURI, "div") : document.createElement("div");
						tipContainer.setAttribute("id", tipContainerID);
						document.getElementsByTagName("body").item(0).appendChild(tipContainer);
					}

					if (!document.getElementById) return;
					this.tip = document.getElementById (this.name);
					document.onmousemove = function (evt) {
						tooltip.move(evt);
						readMouseMove();
					};

					var a, sTitle;
					for (var j = 0; j < qTipTag.length; j ++) { // loop que vai implementar o tool-tip nas tags escolhidas
						anchors = document.getElementsByTagName ( qTipTag[j] ); // pegamos a tag escolhida
						for (var i = 0; i < anchors.length; i ++) { // atribuicao dos tool tips
							a = anchors[i];
							sTitle = a.getAttribute("title"); // pegamos o atributo title
							if(sTitle) { // se estiver setado
								a.setAttribute("tiptitle", sTitle);
								a.removeAttribute("title");
								a.onmouseover = function() {tooltip.show(this.getAttribute('tiptitle'))};
								a.onmouseout = function() {tooltip.hide()};
							}
						}// fim do for
					}
				}

				tooltip.move = function (evt) {
					var x=0, y=0;
					if (document.all) {// IE
						x = (document.documentElement && document.documentElement.scrollLeft) ? document.documentElement.scrollLeft : document.body.scrollLeft;
						y = (document.documentElement && document.documentElement.scrollTop) ? document.documentElement.scrollTop : document.body.scrollTop;
						x += window.event.clientX;
						y += window.event.clientY;

					} else {//Bons Navegadores
						x = evt.pageX;
						y = evt.pageY;
					}
					this.tip.style.left = (x + this.offsetX) + "px";
					this.tip.style.top = (y + this.offsetY) + "px";
				}

				tooltip.show = function (text) {
					if (!this.tip) return;
					this.tip.innerHTML = text;
					this.tip.style.display = "block";
				}

				tooltip.hide = function () {
					if (!this.tip) return;
					this.tip.innerHTML = "";
					this.tip.style.display = "none";
				}

				document.onload = function () {
					tooltip.init ();
				}
		</script>
<header>
<div class="header-interno">
<div class="logo">
	<a href="../../../" title="Pagina Inicial">
		<img src="../../../img/logo.png" class="logo-img">
		<p class="logo-Ani" >Ani Eclipse</p>
	</a>
</div>

<div class="Busca">
	<form name="form_pesquisa" id="form_pesquisa" style="position: relative; height: 100%; width: 100%;" method="post">
		<input  class="input-busca" type="" name="pesquisaCliente" id="pesquisaCliente" placeholder=" Pesquisar anime...">
		<div class="btn-busca"><i class="fa fa-search i-busca" style="font-size:18px;"></i></div>
	</form>

	<div id="contentLoading">
		<div id="loading"></div>
	</div>
</div>
	<section class="jumbotron">
		<div id="MostraPesq"></div>
	</section>
			
            <i class="fa fa-bars ICO-MENU-MOBILE" id="ICO-menu" onclick="menu(this);" data-menu="0"></i>
            <div class="NAV-MOBILE" id="menu">
			<nav class="mobile-nav">

				<div class="Opcao-nav">

					<p class="titulo-Opcao" style="cursor: context-menu;">Conteúdo <i class="fa fa-caret-down"></i></p>

					<ul class="paginas">

						<div class="white-space"></div>

						<a class="link-pagina" href="/animes"><i class="fa fa-th-list"></i> Animes</a>

						<a class="link-pagina" href="/animacoes"><i class="fa fa-rocket"></i> Animações</a>

						<li class="link-pagina generos">

							<i class="fa fa-tags"></i> Gêneros <i class="fa fa-caret-down"></i>

							<ul class="sub-op">

								<div class="white-space-2"></div>
								<?php
									foreach($listaGeneros as $gen){
								?>
								<a class="link-genero" href="/animes?gen=<?=$gen->id?>"><?=$gen->nome?></span></a>
								<?php
									}
								?>
								
							</ul>

						</li>

						<a class="link-pagina" href="../../estudios"><i class="fa fa-film"></i> Estudio</a>

					</ul>

				</div>

				<!-- <div class="Opcao-nav"><a class="titulo-Opcao">Filmes</a></div> -->

				<?php
					$UsuarioLogado;
					if(isset($_SESSION['usuarioLogado'])){
						$UsuarioLogado = new Usuario();
						$UsuarioLogado->id = $_SESSION['usuarioLogado'];
						$UsuarioLogado->fillUsuario();
						
						if($UsuarioLogado->uploader == 1){
				?>
				<div class="Opcao-nav"><a class="titulo-Opcao" href="../../../dashboard">Dashboard</a></div>
				<?php
						}
					}
				?>

			</nav>
			<div class="interacao-user">
				<?php
					if(!isset($_SESSION['usuarioLogado'])){
				?>
			    	<a id="logg" class="titulo-Opcao" title="Entrar com uma conta" href="../../login.php" style="float: right;"><i class="fas fa-sign-in-alt"></i> Logar</a>
			    <?php
			    	}else {
			    ?>
			    	
					<a href="../../perfil.php?id=<?=$UsuarioLogado->id?>" title="<?=$UsuarioLogado->nickname?>" class="link-perfil">
						<div class="PERFIL-user" style="background: url(../../<?=$UsuarioLogado->perfil?>); background-size: cover; background-position-x:center;"></div>
						<h2 class="NOME-user"><?=$UsuarioLogado->nickname?></h2>
					</a>
					<a href="?exit" class="titulo-Opcao logout" title="Sair" style="float: right;">Logout <i class="fas fa-sign-out-alt"></i></a>
			    <?php
					}
			    ?>
			</div>
            </div>
        </div>
		</header>


<?php
	if(isset($_GET['exit'])){
		unset($_SESSION['usuarioLogado']);
		echo "<meta http-equiv='refresh' content='0, url=../../'>";
	}
?>