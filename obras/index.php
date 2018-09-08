<!DOCTYPE html>
<html>
	<head>
	    <link rel="icon" href="../img/logo-negra.png" type="image/x-icon" />
		<link rel="shortcut icon" href="../img/logo-negra.png" type="image/x-icon" />
		<title> Animes - Dimensão Otaku </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="../css/estilo.css" />
		<link rel="stylesheet" type="text/css" href="../css/teste.css" />
		<link rel="stylesheet" href="../css/index-animes-mobile.css" media="(max-width: 640px)"/>
      	<link rel="stylesheet" type="text/css" href="../css/menu.css" />
      	<link rel="stylesheet" href="../css/menu-mobile.css" media="(max-width: 480px)"/>
        <link rel="stylesheet" type="text/css" href="../css/reset.css" />
      	<script src="../js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="../js/controllerObras.js"></script>
		<script src="../js/main.js"></script>
		<script src="../js/jquery.js"></script>
	</head>

	<body onload="exibeAnimes('<?=$_GET['show']?>');">
    <?php
      include("../php/usuario.php");
      include ("../menu.php");
    ?>
          
    <ul class="TodosAnimes" style="padding: 95px 0px;">
      <img src="../img/loading.gif" style="position: relative; float: left; width: 300px; left: 50%; transform: translateX(-50%);">
		</ul>

	</body>
</html>
