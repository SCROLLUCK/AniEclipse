<?php session_start(); ?>
<!DOCTYPE html>
<html>

<?php
    require_once("../class/Anime.php");
    require_once("../class/Episodio.php");
    require_once("../class/Usuario.php");

    if(!isset($_SESSION['usuarioLogado'])){
        header('Location: /');
        die();
    }

    $usuarioLogado = new Usuario();
    $usuarioLogado->id = $_SESSION['usuarioLogado'];
    $usuarioLogado->fillUsuario();

    if(!$usuarioLogado->dev){
        header('Location: /');
        die();
    }
    
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?=$usuarioLogado->nickname?> - Ani Dash</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <!-- Bootstrap Core Css -->
    <link href="../css/bootstrapDash.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../css/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="../css/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/dashboard.css" rel="stylesheet" />
    <link href="../css/loading.css" rel="stylesheet"/>
</head>

<body class="theme-black">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="lds-css ng-scope"><div style="position: relative; float: left; left: 50%; transform: translateX(-50%);" class="lds-eclipse"><div></div></div></div>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- #Top Bar -->
    
    <?php include("sidebar.php"); ?>

    <section class="content">
        <div class="container-fluid" id="mainContentDash">
            
            <div class='block-header'>
                <h2>ANIE DASH</h2>
            </div>
            <div class='row clearfix'>
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <div class='card'>
                    <div class='header'>
                        <h2>Upload Arquivo</h2>
                    </div>
                    <div class='body'>
                    <form method='post' action='../controllers/arquivos.php?novoArquivo' enctype='multipart/form-data'>
                        
                        <div class='row clearfix'>
                            <div class='col-sm-5'>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input required type='text' name='url' class='form-control'>
                                        <label class='form-label'>Url onde o arquivo será upado</label>
                                    </div>
                                </div>
                            </div>
                            <div class='col-sm-4'>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input required type='password' name='senha' class='form-control'>
                                        <label class='form-label'>Sua senha</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='row clearfix'>
                            <div class='col-sm-4'>
                                <div class='form-group'>
                                    <div class='form-line'>
                                        <label>Arquivo</label>
                                        <input type='file' name='arquivo' class='form-control'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <input type='hidden' name='id' value='<?=$usuarioLogado->id?>'>
                    <input type='hidden' name='user' value='<?=$usuarioLogado->nickname?>'>
                    <input type='submit' value='Upload' class='btn waves-effect' style='background: #fb4d26; color: #f5f5f5; font-size: 14pt;'>
                    </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="../js/jquery-1.11.1.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../js/bootstrap.js"></script>

    <!-- Select Plugin Js 
    <script src="../js/bootstrap-select.js"></script>-->

    <!-- Slimscroll Plugin Js -->
    <script src="../js/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../js/waves.js"></script>

    <!-- Morris Plugin Js -->
    <script src="../js/raphael.min.js"></script>
    <script src="../js/morris.js"></script>
    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/dashboard.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
</body>

</html>