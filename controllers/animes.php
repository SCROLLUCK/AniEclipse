<?php

    $pathServer = "/home/storage/c/29/18/anieclipse3/public_html/";
    $pathDocker = "/home/lse/REPOS/AnieEclipse";

    if(file_exists($pathServer)){
        require_once($pathServer."/class/Usuario.php");
        require_once($pathServer."/class/Episodio.php");
        require_once($pathServer."/class/Anime.php");
    }else {
        require_once($pathDocker."/class/Usuario.php");
        require_once($pathDocker."/class/Episodio.php");
        require_once($pathDocker."/class/Anime.php");
    }

    $target="animes.php";
    $proprioArquivo = FALSE;
    if(basename($_SERVER["PHP_SELF"])== $target){
        $proprioArquivo = TRUE;
    }

    //COMPARA DUAS OBRAS PELO NOME
    function comparadorObras($obra1,$obra2){
        return strcmp($obra1->nome,$obra2->nome);
    }

    //LISTA TODOS OS ANIMES DO SITE EM ORDEM ALFABETICA
    function listarTodosAnimes($metodo){
        if($metodo == 'quick'){
            try{
                $listaAnimesTotal = [];
                $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
                $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
                $resultAnime = $db->query("SELECT idObra, obras.nome, obras.diretorio, obras.capa, obras.sinopse FROM animes, obras WHERE obras.id = idObra ORDER BY obras.nome");
                while($rowAnime = $resultAnime->fetch(PDO::FETCH_OBJ)){
                    $animeAtual = new Anime();
                    $animeAtual->fill($rowAnime);
                    $animeAtual->tipo = "Anime";

                    $listaAnimesTotal[] = $animeAtual;
                }

                unset($db);
                return $listaAnimesTotal;

            }catch(PDOException $exception){
                unset($db);
                echo $exception;
                die();
            }
        }else if($metodo == 'full'){
            //REALLY?
        }
    }

    //LISTA TODOS OS ANIMES QUE NÃO SÃO LANCAMENTOS EM ORDEM DECRESCENTE DE CADASTRO
    function listarAnimesRecentes($metodo){
        if($metodo == 'quick'){
            try{
                $listaAnimesRecentes = [];
                $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
                $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
                $resultAnime = $db->query("SELECT idObra, obras.nome, obras.diretorio, obras.capa, obras.sinopse FROM animes, obras WHERE obras.id = idObra AND obras.status != 'Lançando' ORDER BY idObra DESC LIMIT 14");
                while($rowAnime = $resultAnime->fetch(PDO::FETCH_OBJ)){
                    $animeAtual = new Anime();
                    $animeAtual->fill($rowAnime);

                    $listaAnimesRecentes[] = $animeAtual;
                }

                unset($db);
                return $listaAnimesRecentes; 

            }catch(PDOException $exception){
                unset($db);
                echo $exception;
                die();
            }

        }else if($metodo == 'full'){
            //REALLY?
        }
    }

    function listarAnimesLancamentos($metodo){
        if($metodo == 'quick'){
            try{
                $listaAnimesLancamentos = [];
                $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
                $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
                $resultAnime = $db->query("SELECT idObra, obras.nome, obras.diretorio, obras.capa, obras.sinopse FROM animes, obras WHERE obras.id = idObra AND obras.status = 'Lançando' ORDER BY idObra DESC LIMIT 15");
                while($rowAnime = $resultAnime->fetch(PDO::FETCH_OBJ)){
                    $animeAtual = new Anime();
                    $animeAtual->fill($rowAnime);
    
                    $listaAnimesLancamentos[] = $animeAtual;
                }
    
                unset($db);
                return $listaAnimesLancamentos;
    
            }catch(PDOException $exception){
                unset($db);
                echo $exception;
                die();
            }
        }else if($metodo == 'full'){
            //REALLY?
        }
    }

    function listarAnimesPorGenero($genero, $metodo){
        if($metodo == 'quick'){
            try{
                $listaAnimesGenero = [];
                $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
                $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    
                $resultObras = $db->query("SELECT obras.id, nome, diretorio, capa, sinopse FROM obras, rObraGenero WHERE rObraGenero.idObra = obras.id AND rObraGenero.idGenero = '$genero' ORDER BY nome");
                while($rowObras = $resultObras->fetch(PDO::FETCH_OBJ)){
                    $animeAtual = new Anime();
                    $animeAtual->fill($rowObras);
    
                    $listaAnimesGenero[] = $animeAtual;
                }
    
                unset($db);
                return $listaAnimesGenero;
    
            }catch(PDOException $exception){
                unset($db);
                echo $exception;
                die();
            }
        }else if($metodo == 'full'){
            //REALLY?
        }
    }

    if(isset($_GET['recentes']) && $proprioArquivo){
        $listaAnimesRecentes = listarAnimesRecentes('quick');

        header("Content-Type: application/json");

        echo json_encode($listaAnimesRecentes);

    }

    if(isset($_GET['lancamentos']) && $proprioArquivo){
        $listaLancamentos = listarAnimesLancamentos('quick');

        header("Content-Type: application/json");

        echo json_encode($listaLancamentos);
    }

    if(isset($_GET['todos']) && $proprioArquivo){
        $listaAnimesGeral = listarTodosAnimes('quick');

        header("Content-Type: application/json");

        echo json_encode($listaAnimesGeral);
    }

    if(isset($_GET['gen']) && $proprioArquivo){
        $idGenero = $_GET['gen'];
        $listaAnimesGenero = listarAnimesPorGenero($idGenero, 'quick');

        header("Content-Type: application/json");

        echo json_encode($listaAnimesGenero);
    }

    if(isset($_GET['novoAnime'])){
        
        $usuarioLog = new Usuario();
        $usuarioLog->nickname = $_POST['user'];
        $usuarioLog->setPasswd($_POST['senha']);

        if($usuarioLog->auth()){

            $pastaAnime = $_POST['nomePastaAnime'];
            $criouUma = mkdir("/home/storage/c/29/18/anieclipse3/public_html/animes/$pastaAnime", 0777);
            $criouOutra = mkdir("/home/storage/c/29/18/anieclipse3/public_html/animes/$pastaAnime/img", 0777);

            if($criouUma && $criouOutra){

                $diretorio = "/home/storage/c/29/18/anieclipse3/public_html/animes/$pastaAnime/img/";
                
                $tempCapa = $_FILES['capaAnime']['tmp_name'];
                $finalCapa = $_FILES['capaAnime']['name'];
                $tempBack = $_FILES['backAnime']['tmp_name']; 
                $finalBack = $_FILES['backAnime']['name'];
                $tempLogo = $_FILES['logoAnime']['tmp_name'];
                $finalLogo = $_FILES['logoAnime']['name'];

                $upouCapa = move_uploaded_file($tempCapa,$diretorio.$finalCapa); 
                $upouBack = move_uploaded_file($tempBack,$diretorio.$finalBack); 
                $upouLogo = move_uploaded_file($tempLogo,$diretorio.$finalLogo); 

                if($upouCapa && $upouBack && $upouLogo){

                    $novoAnime = new Anime();
                    $novoAnime->nome                    = $_POST['nomeAnime'];
                    $novoAnime->nomeAlternativo         = $_POST['nomeAlternativo'];
                    $novoAnime->idade                   = $_POST['faixaEtaria'];
                    $novoAnime->temporadaAtual          = $_POST['temporadaAtual'];
                    $novoAnime->temporadaAnterior       = $_POST['temporadaAnterior'];
                    $novoAnime->temporadaPosterior      = $_POST['temporadaPosterior'];
                    $novoAnime->sinopse                 = $_POST['sinopse'];
                    $novoAnime->numeroEpisodios         = $_POST['numeroEpisodios'];
                    $novoAnime->qualidadeMax            = $_POST['qualidadeMax'];
                    $novoAnime->transmissao             = $_POST['transmissao'];
                    $novoAnime->numeroTemporadas        = $_POST['numeroTemporadas'];
                    $novoAnime->roteirista              = $_POST['roteirista'];
                    $novoAnime->estudio                 = $_POST['estudio'];
                    $novoAnime->site                    = $_POST['site'];
                    $novoAnime->trailler                = $_POST['trailler'];
                    $novoAnime->estreia                 = $_POST['estreia'];
                    $novoAnime->fonte                   = $_POST['fonte'];
                    $novoAnime->numeroOvas              = $_POST['numeroOvas'];
                    $novoAnime->status                  = $_POST['status'];
                    $novoAnime->diretorio               = "animes/".$pastaAnime;
                    $novoAnime->capa                    = $_FILES['capaAnime']['name'];
                    $novoAnime->background              = $_FILES['backAnime']['name'];
                    
                    $novoAnime->uploader                = $_POST['id'];
                    $novoAnime->audio                   = '0';

                    $novoAnime->save();

                    echo "<script>alert('Anime cadastrado com sucesso!');</script>";
                    echo "<meta http-equiv='refresh' content='0, url=../dashboard'>";
                }
            }else {
                echo "Falha na criação de pastas";
            }
        }else {
            echo "Falha de autenticação";
        }
    }

?>