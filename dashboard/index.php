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

    if($usuarioLogado->uploader != 1){
        header('Location: /');
        die();
    }

    $listaEpsUpadosUser = $usuarioLogado->episodiosUpados();
    $listaAnimesResponsavel = $usuarioLogado->animesResponsavel();
    
    $epsUpadosUser = $usuarioLogado->numeroEpisodiosUpados();
    $animesResponsavel = $usuarioLogado->numeroAnimesResponsavel();

    $valorSoma = $epsUpadosUser + $usuarioLogado->curtidas;

    $eficienciaUser = ( (1)/(1+exp(-$valorSoma)) )*100;
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
            <div class="block-header">
                <h2>ANI DASH</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="far fa-play-circle"></i>
                        </div>
                        <div class="content">
                            <div class="text">EPISÓDIOS UPADOS</div>
                            <div class="number count-to"><?=$epsUpadosUser?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="far fa-file-video"></i>
                        </div>
                        <div class="content">
                            <div class="text">ANIMES</div>
                            <div class="number count-to"><?=$animesResponsavel?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="far fa-heart"></i>
                        </div>
                        <div class="content">
                            <div class="text">CURTIDAS</div>
                            <div class="number count-to"><?=$usuarioLogado->curtidas?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-percentage"></i>
                        </div>
                        <div class="content">
                            <div class="text">EFICIÊNCIA</div>
                            <div class="number count-to"><?=$eficienciaUser?></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->

            <div class="row clearfix">
                <!-- Episodios -->
                <div class="col-sm-6">
                    <div class="card">
                        <div class="header">
                            <h2>Episódios</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>Obra</th>
                                            <th>Episódio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($listaEpsUpadosUser as $epUpado){
                                        ?>
                                        <tr>
                                            <td><?=$epUpado->obra->nome?></td>
                                            <td><?=$epUpado->numero?></td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-sm-6'>
                    <div class='card'>
                        <div class='header'>
                            <h2>Animes</h2>
                        </div>
                        <div class='body' style="height: 512px; overflow-y: auto;">
                            <div class='table-responsive'>
                                <table class='table table-hover dashboard-task-infos'>
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Episódios</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($listaAnimesResponsavel as $animeResp){
                                                $epsUp = $animeResp->episodiosUpados();
                                        ?>
                                        <tr>
                                            <td><?=$animeResp->nome?></td>
                                            <td><?=$epsUp?>/<?=$animeResp->numeroEpisodios?></td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="../js/jquery-1.11.1.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../js/bootstrap-select.js"></script>

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