<?php 
	header('Location: http://localhost:8080');
	die();

	$pathServer = "/home/storage/c/29/18/anieclipse3/public_html/";
	$pathDocker = "/home/lse/REPOS/AnieEclipse";

    if(file_exists($pathServer)){
		require_once($pathServer."/class/Usuario.php");
    }else {
		require_once($pathDocker."/class/Usuario.php");
	}
	
	$manogray = new Usuario();
	$scrolluck = new Usuario();
	$strneoh = new Usuario();
	$manogray->id = 1;
	$scrolluck->id = 3;
	$strneoh->id = 13;
	$manogray->fillUsuario();
	$scrolluck->fillUsuario();
	$strneoh->fillUsuario();

?>
<!--
<!DOCTYPE html>
<html>
	<?php
		$titlePagina = "Equipe - Ani Eclipse";
		//include("includes/head.php"); 
	?>
	<link rel="stylesheet" href="css/equipe.css">

	<body style="background: url(img/shinmai.jpg);background-size: 100%;">
	<div class="BACK" style="background: rgba(0,0,0,0.7); width: 100%;float: left;">
		<?php //include("includes/menu.php");?>
		<div id="wrap_Equipe" style="margin-top: 80px;">
			<script type="text/javascript">
				function info(y){
					var listaMembros = document.getElementsByClassName("Membros");
					var contentDetalhes = document.getElementsByClassName("Mais-detalhes");
					if(contentDetalhes[y].style.display == "block" ){
						if(y != 0){
							listaMembros[y].style.width = "576px";
						}
						contentDetalhes[y].style.display = "none";
					}else{
						if(y != 0){
							listaMembros[y].style.width = "98%";
						}
						contentDetalhes[y].style.display = "block";
					}	
				}
			</script>
			<ul class="Membros" style="background: #f44336; box-shadow: 1px 3px 7px 0px rgb(21, 20, 20); width: 100%; margin: 12px 0; min-height: initial;">
				<h2 style="color: white;" >Fundadores</h2>
				<p style="color: #1e1e1e; font-weight: bold;"><span class="Enfase" style="font-weight:bold;">FUNDADORES:</span> Membros originais da elaboração do site. O Ani Eclipse é um projeto que foi fundado pelo manogray, STRNeoh e eu. Atualmente o site conta com mais alguns colaboradores.</p>
				<div class="Users">
					<li class="Perfil" style="background:url(<?=$scrolluck->perfil?>);background-size:cover; background-position-x:center">
						<a class="a-perfil" href="perfil.php?id=3"></a>
						<p class="Info-USER">SCROLLUCK</p>
					</li>
					<li class="Perfil" style="background:url(<?=$manogray->perfil?>);background-size:cover; background-position-x:center">
						<a class="a-perfil" href="perfil.php?id=1"></a>
						<p class="Info-USER">manogray</p>
					</li>
					<li class="Perfil" style="background:url(<?=$strneoh->perfil?>);background-size:cover; background-position-x:center">
						<a class="a-perfil" href="perfil.php?id=13"></a>
						<p class="Info-USER">STRNeoh</p>
					</li>
				</div>
				
			</ul>
			<ul class="Membros">
				<h2>Desenvolvedor <i class="fab fa-html5 desenvolvedor" style="font-size: 22px;"></i></h2>
				<a class="M-detalhes" style="background:#de1111;" onclick="info(0)"><i class="fa fa-info-circle"></i> Mais detalhes</a>
				<p><span class="Enfase">DESENVOLVEDORES:</span> São responsáveis pelo desenvolvimento e manutenção do site. Programação e estilização são algumas das atividades cotidianas, bugs e erros relacionados ao site, deverão ser relatados a estes usuários.</p>

				<div class="Mais-detalhes">
					<p style="clear: none;"><span class="Enfase" style="color:#de1111;">BACKEND:</span> O Backend é desenvolvido utilizando PHP. Atualmente o densenvolvedor responsável é o manogray. </p>

					<p style="clear: none; width:320px"><span class="Enfase" style="color:#de1111;">FRONTEND:</span> O Frontend atualmente é responsabilidade do SCROLLUCK e utiliza apenas HTML, CSS e Javascript puro. </p>

					<p style="clear: none;"><span class="Enfase" style="color:#de1111;">MOBILE:</span> A parte mobile da plataforma ainda não está em desenvolvimento e estamos aceitando propostas de solução. =)</p>

					<a class="interresado">Tenho interesse!</a>
				</div>
			</ul>
			<ul class="Membros">
				<h2>Uploader <i class="fa fa-upload uploader" style="font-size: 22px;"></i></h2>
				<a class="M-detalhes" onclick="info(1)"><i class="fa fa-info-circle"></i> Mais detalhes</a>
				<p><span class="Enfase">UPLOADERS:</span> São usuários que upam episodios ou filmes no site, essa função é muito importante e é sempre bom ter muitos rs, qualquer usuário pode se tornar um UPLOADER, basta atender os requisitos necessários, veja mais detalhes se estiver interressado.</p>

				<div class="Mais-detalhes">
					<p style="clear: none;"><span class="Enfase" style="color:#ff6600;">TEMPO:</span> Este é o primeiro requisito para ser um UPLOADER. Baixar, assistir e upar, são 3 passos simples. A maioria já está acostumada com o segundo, o tempo que isso leva depende de vários fatores, um deles é o tempo que você tem disponível. Determinar um tempo para upar seus episódios é essencial. O Up pelo site é bem simples, então, se está com tempo sobrando e gosta de animes já tem quase tudo que um UPLOADER precisa kk.</p>

					<p style="clear: none; width:320px"><span class="Enfase" style="color:#ff6600;">INTERNET:</span> O Segundo requisto. Bom, aqui não há como escapar, para episodios ou filmes com qualidade 1080p(FullHD) sua velocidade de internet tem que ser boa e sua conexão estável.</p>

					<p style="clear: none;"><span class="Enfase" style="color:#ff6600;">COMPROMISSO:</span> Por fim o último requisito, e o mais importante. Se quiser fazer parte da Equipe você terá que seguir os dois requisitos anteriores, tendo em mente que esse serviço não é remunerado, é algo de fã pra fã. Dito isso, mãos à obra!</p>

					<a class="interresado">Tenho interesse!</a>

				</div>
			</ul>

			<!-- EXEMPLIFICAR ISSO MELHOR
			<ul class="Membros">
				<h2>Legendador</h2>
				<a class="M-detalhes" onclick="info(2)"><i class="fa fa-info-circle"></i> Mais detalhes</a>
				<p><span class="Enfase">LEGENDADORES:</span> São usuários que legendam episodios ou filmes. O Ani Eclipse não possui nenhum usuário do gênero, mas seria muito bom ter. Se você tem interesse, veja em mais detalhes e venha fazer parte da nossa Equipe.</p>
				<div class="Users">
					<p>Nenhum usuário no momento.</p>
				</div>

				<div class="Mais-detalhes">
					<p><span class="Enfase">DESENVOLVEDORES:</span> São responsáveis pelo desenvolvimento e manutenção do site. Programação e estilização são algumas das atividades cotidianas, bugs e erros relacionados ao site, deverão ser relatados a estes usuários.</p>
					<p><span class="Enfase">DESENVOLVEDORES:</span> São responsáveis pelo desenvolvimento e manutenção do site. Programação e estilização são algumas das atividades cotidianas, bugs e erros relacionados ao site, deverão ser relatados a estes usuários.</p>
					<p><span class="Enfase">DESENVOLVEDORES:</span> São responsáveis pelo desenvolvimento e manutenção do site. Programação e estilização são algumas das atividades cotidianas, bugs e erros relacionados ao site, deverão ser relatados a estes usuários.</p>

				</div>
			</ul> -->
		</div>
	</div>
	<div class="Sites-Parceiros">
		<ul class="LISTA-SITES">
			<li class="SITE">
				<div class="PROMO"></div>
			</li>
		</ul>
		
	</div>
	</body>
</html>