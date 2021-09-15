<?php 
	session_start();

	$tipoObra = "";
    if($_SERVER["PHP_SELF"] == "/animes/index.php"){
        $tipoObra = "animes";
    }else if($_SERVER["PHP_SELF"] == "/animacoes/index.php"){
		$tipoObra = "animacoes";
	}
?>
<!DOCTYPE html>
<html>
	<?php
		$tipoObra == "animes" ? $titlePagina = "Animes - Ani Eclipse": $titlePagina = "Animações - Ani Eclipse"; 
		include("../includes/head.php");

		$temGet = FALSE;
		
		if(isset($_GET['gen'])){
			$temGet = TRUE;
			$idGenero = $_GET['gen'];
		}
	?>
	<link rel="stylesheet" type="text/css" href="../css/teste.css">
	
	<?php
		if(!$temGet){
	?>
	<body onload="main();" style="background: #3b3a3a;">
	<?php
		}else {
	?>
	<body onload="animesGenero(<?=$idGenero?>);" style="background: #3b3a3a;">
	<?php
		}
	?>
    
	<?php include("../includes/menu.php"); ?>
          
    <ul class="TodosAnimes" id="boxObras" style="padding: 95px 0px;">
	<div class="lds-css ng-scope"><div style="position: relative; float: left; left: 50%; transform: translateX(-50%);" class="lds-eclipse"><div></div></div></div>
	</ul>

	<!--LIB AXIOS-->
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	
	<?php 
		if($tipoObra == "animes"){
	?>
	<script type="text/javascript" src="../js/animesAjax.js"></script>
	<?php
		}else {
	?>
	<script type="text/javascript" src="../js/animacoesAjax.js"></script>
	<?php
		}
	?>
	</body>
</html>
