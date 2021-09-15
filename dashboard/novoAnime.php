<?php session_start(); ?>
<!DOCTYPE html>
<html>

<?php
    require_once("../class/Anime.php");
    require_once("../class/Episodio.php");
    require_once("../class/Usuario.php");
    require_once("../controllers/animes.php");

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

    $listaAnimes = listarTodosAnimes('quick');
    
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
                        <h2>Novo Anime</h2>
                    </div>
                    <div class='body'>
                    <form method='post' action='../controllers/animes.php?novoAnime' enctype='multipart/form-data'>
                        <div class='row clearfix'>
                            <div class='col-sm-4'>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input required type='text' name='nomeAnime' class='form-control'>
                                        <label class='form-label'>Nome do Anime</label>
                                    </div>
                                </div>
                            </div>
                            <div class='col-sm-4'>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input type='text' name='nomeAlternativo' class='form-control'>
                                        <label class='form-label'>Nome alternativo</label>
                                    </div>
                                </div>
                            </div>
                            <div class='col-sm-4'>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input required type='number' name='faixaEtaria' class='form-control'>
                                        <label class='form-label'>Faixa Etária</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='row clearfix'>
                            <div class='col-sm-4'>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input required type='number' name='temporadaAtual' class='form-control'>
                                        <label class='form-label'>Temporada Atual</label>
                                    </div>
                                </div>
                            </div>
                            <div class='col-sm-4'>
                                <label>Temporada Anterior</label>
                                <select required name='temporadaAnterior' class='form-control'>
                                    <option value>Selecione um anime</option>
                                    <option value='0'>Não possui</option>
                                    <?php
                                        foreach($listaAnimes as $anime){
                                    ?>
                                    <option value='<?=$anime->id?>'><?=$anime->nome?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class='col-sm-4'>
                                <label>Temporada Posterior</label>
                                <select required name='temporadaPosterior' class='form-control'>
                                    <option value>Selecione um anime</option>
                                    <option value='0'>Não possui</option>
                                    <?php
                                        foreach($listaAnimes as $anime){
                                    ?>
                                    <option value='<?=$anime->id?>'><?=$anime->nome?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class='row clearfix'>
                            <div class='col-sm-12'>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <textarea name='sinopse' required rows='5' class='form-control no-resize'></textarea>
                                        <label class='form-label'>Sinopse</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='row clearfix'>
                            <div class='col-sm-4'>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input required type='text' name='numeroEpisodios' class='form-control'>
                                        <label class='form-label'>Número de Episódios (Use '??' se não souber)</label>
                                    </div>
                                </div>
                            </div>
                            <div class='col-sm-4'>
                                <label>Qualidade máxima dos episódios</label>
                                <select required name='qualidadeMax' class='form-control'>
                                    <option value>Resolução</option>
                                    <option value='144p'>144p</option>
                                    <option value='240p'>240p</option>
                                    <option value='360p'>360p</option>
                                    <option value='480p'>480p (SD)</option>
                                    <option value='720p'>720p (HD)</option>
                                    <option value='1080p'>1080p (Full-HD)</option>
                                </select>
                            </div>
                            <div class='col-sm-4'>
                                <label>Dia que lança o episódio</label>
                                <select required class='form-control' name='transmissao'>
                                    <option value>Selecione um dia</option>
                                    <option value='Finalizado'>Finalizado</option>
                                    <option value='Segunda-feira'>Segunda-feira</option>
                                    <option value='Terça-feira'>Terça-feira</option>
                                    <option value='Quarta-feira'>Quarta-feira</option>
                                    <option value='Quinta-feira'>Quinta-feira</option>
                                    <option value='Sexta-feira'>Sexta-feira</option>
                                    <option value='Sábado'>Sábado</option>
                                    <option value='Domingo'>Domingo</option>
                                </select>
                            </div>
                        </div>
                        <div class='row clearfix'>
                            <div class='col-sm-4'>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input required type='number' name='numeroTemporadas' class='form-control'>
                                        <label class='form-label'>Número de temporadas</label>
                                    </div>
                                </div>
                            </div>
                            <div class='col-sm-4'>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input required type='text' name='roteirista' class='form-control'>
                                        <label class='form-label'>Mangaká ou Roteirista</label>
                                    </div>
                                </div>
                            </div>
                            <div class='col-sm-4'>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input required type='text' name='estudio' class='form-control'>
                                        <label class='form-label'>Estúdio</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='row clearfix'>
                            <div class='col-sm-4'>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input type='text' name='site' class='form-control'>
                                        <label class='form-label'>Site do Anime</label>
                                    </div>
                                </div>
                            </div>
                            <div class='col-sm-4'>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input type='text' name='trailler' class='form-control'>
                                        <label class='form-label'>Link(incorporado) para o trailler do Anime</label>
                                    </div>
                                </div>
                            </div>
                            <div class='col-sm-4'>
                                <div class='form-group'>
                                    <div class='form-line'>
                                        <label>Data de estreia</label>
                                        <input required type='date' name='estreia' class='form-control'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='row clearfix'>
                            <div class='col-sm-4'>
                                <label>Fonte da história</label>
                                <select name='fonte' class='form-control'>
                                    <option value>Selecione um</option>
                                    <option value='Mangá'>Mangá</option>
                                    <option value='Original'>Original do Estúdio</option>
                                    <option value='Game'>Game</option>
                                    <option value='Livro'>Livro</option>
                                    <option value='Filme'>Filme</option>
                                    <option value='Light'>Light Novel</option>
                                </select>
                            </div>
                            <div class='col-sm-4'>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input type='number' name='numeroOvas' class='form-control'>
                                        <label class='form-label'>Número de OVAs</label>
                                    </div>
                                </div>
                            </div>
                            <div class='col-sm-4'>
                                <label>Status do Anime</label>
                                <select name="status" required class='form-control'>
                                    <option value>Selecione um</option>
                                    <option value='Completo'>Completo</option>
                                    <option value='Lançando'>Lançando</option>
                                </select>
                            </div>
                        </div>
                        <div class='row clearfix'>
                            <div class='col-sm-4'>
                                <div class='form-group form-float'>
                                    <div class='form-line'>
                                        <input required type='text' name='nomePastaAnime' class='form-control'>
                                        <label class='form-label'>Nome da pasta do Anime</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='row clearfix'>
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
                                        <label>Capa do Anime</label>
                                        <input type='file' name='capaAnime' class='form-control'>
                                    </div>
                                </div>
                            </div>
                            <div class='col-sm-4'>
                                <div class='form-group'>
                                    <div class='form-line'>
                                        <label>Background do Anime</label>
                                        <input type='file' name='backAnime' class='form-control'>
                                    </div>
                                </div>
                            </div>
                            <div class='col-sm-4'>
                                <div class='form-group'>
                                    <div class='form-line'>
                                        <label>Logo do Anime</label>
                                        <input type='file' name='logoAnime' class='form-control'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <input type='hidden' name='id' value='<?=$usuarioLogado->id?>'>
                    <input type='hidden' name='user' value='<?=$usuarioLogado->nickname?>'>
                    <input type='submit' value='Cadastrar' class='btn waves-effect' style='background: #fb4d26; color: #f5f5f5; font-size: 14pt;'>
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