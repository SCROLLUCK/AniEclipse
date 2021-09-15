<!DOCTYPE html>
<html>
	<?php 
		$titlePagina = "Animes - Dimensão Otaku"; 
		include("../includes/head.php");
	?>
	<link rel="stylesheet" type="text/css" href="../css/teste.css">


	<?php
		if(!isset($_GET['show']) && !isset($_GET['gen'])){
	?>
			<body onload="exibirLista('animes');">
	<?php
		}else if(isset($_GET['gen'])) {	
	?>
			<body onload="exibirLista(<?=$_GET['gen']?>,'quick');">
	<?php
		}
	?>
    <?php
    //   include("../php/usuario.php");
      include ("../includes/menu.php");
    ?>
          
    <ul id="LISTA" class="TodosAnimes" style="padding: 95px 0px;">
		<div class="lds-css ng-scope"><div style="position: relative; float: left; left: 50%; transform: translateX(-50%);" class="lds-eclipse"><div></div></div></div>
	</ul>

	<!--LIB AXIOS-->
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="http://localhost:8080/js/main.js"></script>
	<script type="text/javascript" src="http://localhost:8080/controllers/animes.php"></script>
</body>
</html>
