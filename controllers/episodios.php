<?php

    $pathServer = "/home/storage/c/29/18/anieclipse3/public_html/";
    $pathDocker = "/home/lse/REPOS/AnieEclipse";

    if(file_exists($pathServer)){
        require_once($pathServer."/class/Usuario.php");
        require_once($pathServer."/class/Anime.php");
        require_once($pathServer."/class/Animacao.php");
        require_once($pathServer."/class/Episodio.php");

        require_once($pathServer."/controllers/animes.php");
        require_once($pathServer."/controllers/animacoes.php");
    }else {
        require_once($pathDocker."/class/Usuario.php");
        require_once($pathDocker."/class/Anime.php");
        require_once($pathDocker."/class/Animacao.php");
        require_once($pathDocker."/class/Episodio.php");

        require_once($pathDocker."/controllers/animes.php");
        require_once($pathDocker."/controllers/animacoes.php");
    }

    $target="episodios.php";
    $proprioArquivo = FALSE;
    if(basename($_SERVER["PHP_SELF"])== $target){
        $proprioArquivo = TRUE;
    }

    //COMPARA EPISODIOS DE OBRAS POR ID EM ORDEM DECRESCENTE
    function comparadorEpisodios($episodio1,$episodio2){
        if($episodio1->id < $episodio2->id){
            return 1;
        }else if($episodio2->id < $episodio1->id){
            return -1;
        }else {
            return 0;
        }
    }

    function listarEpisodiosLancamento(){
        try {
            $listaEpisodios = [];
            $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
            $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            $resultEpisodiosLancamento = $db->query("SELECT episodios.id, episodios.nome, episodios.numero, episodios.thumb, episodios.duracao, episodios.dataPostagem, obras.nome AS nomeObra, obras.diretorio, obras.numeroEpisodios FROM episodios, obras WHERE obras.id = episodios.idObra AND episodios.id IN (SELECT MAX(id) FROM episodios WHERE idObra in (SELECT id from obras WHERE status = 'Lançando') GROUP BY idObra) ORDER By dataPostagem DESC");
            while($rowEpisodioLancamento = $resultEpisodiosLancamento->fetch(PDO::FETCH_OBJ)){
                $episodioAtual = new Episodio();
                $episodioAtual->fill($rowEpisodioLancamento);
                $episodioAtual->obra = new Anime();
                $episodioAtual->obra->nome = $rowEpisodioLancamento->nomeObra;
                $episodioAtual->obra->diretorio = $rowEpisodioLancamento->diretorio;
                $episodioAtual->obra->numeroEpisodios = $rowEpisodioLancamento->numeroEpisodios;

                $episodioAtual->numero == $episodioAtual->obra->numeroEpisodios ? $episodioAtual->final = TRUE : $episodioAtual->final = FALSE;

                $listaEpisodios[] = $episodioAtual;
            }
            unset($db);

            return $listaEpisodios;

        }catch(PDOException $exception){
            unset($db);
            echo $exception->getMessage();
            die();
        }
    }

    function listarEpisodiosRecentes(){
        try {
            $listaEpisodios = [];
            $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
            $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            $resultEpisodiosRecentes = $db->query("SELECT episodios.id, episodios.nome, episodios.numero, episodios.thumb, episodios.duracao, episodios.dataPostagem, obras.nome AS nomeObra, obras.diretorio, obras.numeroEpisodios FROM episodios, obras WHERE obras.id = episodios.idObra AND episodios.id IN (SELECT MAX(id) FROM episodios WHERE idObra in (SELECT id from obras WHERE status = 'Completo') GROUP BY idObra) ORDER By dataPostagem DESC LIMIT 14");
            while($rowEpisodiosRecentes = $resultEpisodiosRecentes->fetch(PDO::FETCH_OBJ)){
                $episodioAtual = new Episodio();
                $episodioAtual->fill($rowEpisodiosRecentes);
                $episodioAtual->obra = new Anime();
                $episodioAtual->obra->nome = $rowEpisodiosRecentes->nomeObra;
                $episodioAtual->obra->diretorio = $rowEpisodiosRecentes->diretorio;
                $episodioAtual->obra->numeroEpisodios = $rowEpisodiosRecentes->numeroEpisodios;

                $episodioAtual->numero == $episodioAtual->obra->numeroEpisodios ? $episodioAtual->final = TRUE : $episodioAtual->final = FALSE;

                $listaEpisodios[] = $episodioAtual;
            }
            unset($db);

            return $listaEpisodios;

        }catch(PDOException $exception){
            unset($db);
            echo $exception->getMessage();
            die();
        }
    }

    function listarEpisodiosAnimacoes(){

    }

    function listarEpisodiosObra($obra){
        try{
            $listaEpisodios = [];
            $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
            $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            $resultEpisodiosObra = $db->query("SELECT id, nome, numero, thumb, duracao, temporada FROM episodios WHERE idObra = '$obra->id' ORDER BY numero");
            while($rowEpisodios = $resultEpisodiosObra->fetch(PDO::FETCH_OBJ)){
                $episodio = new Episodio();
                $episodio->fill($rowEpisodios);
                $episodio->temporada = $rowEpisodios->temporada;
                $episodio->obra = $obra;

                $listaEpisodios[] = $episodio;
            }

            unset($db);
            return $listaEpisodios;

        }catch(PDOException $exception){
            unset($db);
            echo $exception->getMessage();
            die();
        }
    }

    function listarEpisodiosPorTemporada($obra,$temporada){
        try{
            $listaEpisodios = [];
            $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
            $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            $resultEpisodiosObra = $db->query("SELECT id, nome, numero, thumb, duracao, temporada FROM episodios WHERE idObra ='$obra->id' AND temporada='$temporada' ORDER BY numero");
            while($rowEpisodios = $resultEpisodiosObra->fetch(PDO::FETCH_OBJ)){
                $episodio = new Episodio();
                $episodio->fill($rowEpisodios);
                $episodio->temporada = $rowEpisodios->temporada;
                $episodio->obra = $obra;

                $listaEpisodios[] = $episodio;
            }

            unset($db);
            return $listaEpisodios;

        }catch(PDOException $exception){
            unset($db);
            echo $exception->getMessage();
            die();
        }
    }

    function listarEpisodiosAssistir($epAtual,$idObra){
        try{
            $listaEpisodios = [];
            $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
            $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            $resultEpisodios = $db->query("SELECT episodios.nome, episodios.numero, episodios.duracao, episodios.temporada, episodios.thumb, obras.nome as nomeObra, obras.diretorio FROM episodios, obras WHERE episodios.idObra = obras.id AND episodios.idObra = '$idObra' AND episodios.numero > '$epAtual'");
            while($rowEpisodios = $resultEpisodios->fetch(PDO::FETCH_OBJ)){
                $episodio = new Episodio();
                $episodio->fill($rowEpisodios);
                $episodio->temporada = $rowEpisodios->temporada;
                $episodio->obra = new Anime();
                $episodio->obra->nome = $rowEpisodios->nomeObra;
                $episodio->obra->diretorio = $rowEpisodios->diretorio;

                $listaEpisodios[] = $episodio;
            }
            unset($db);
            return $listaEpisodios;
        }catch(PDOException $exception){
            unset($db);
            echo $exception->getMessage();
            die();
        }
    }


    if(isset($_GET['lancamentos']) && $proprioArquivo){
        $listaEpisodiosLanca = listarEpisodiosLancamento();

        usort($listaEpisodiosLanca, 'comparadorEpisodios');

        header("Content-Type: application/json");

        echo json_encode($listaEpisodiosLanca);
    }

    if(isset($_GET['recentes']) && $proprioArquivo){
        $listaEpisodiosRecente = listarEpisodiosRecentes();

        usort($listaEpisodiosRecente, 'comparadorEpisodios');

        echo json_encode($listaEpisodiosRecente);
    }

    if(isset($_GET['obra']) && !isset($_GET['temporada']) && $proprioArquivo ){
        $obra = new Anime();
        $obra->id = $_GET['obra'];
        $obra->fillQuick();

        $listaEpisodiosObra = listarEpisodiosObra($obra);

        echo json_encode($listaEpisodiosObra);
    }

    if(isset($_GET['obra']) && isset($_GET['temporada']) && $proprioArquivo ){

        $obra = new Anime();
        $obra->id = $_GET['obra'];
        $obra->fillQuick();
        
        $listaEpisodiosPorTemporada = listarEpisodiosPorTemporada($obra,$_GET['temporada']);

        echo json_encode($listaEpisodiosPorTemporada);
    }

    if(isset($_GET['novoEpisodio'])){

        $usuarioLog = new Usuario();
        $usuarioLog->nickname = $_POST['user'];
        $usuarioLog->setPasswd($_POST['senha']);

        if(!$usuarioLog->auth()){
            echo "<script>alert('Senha incorreta!');</script>";
            echo "<meta http-equiv='refresh' content='0, url=/dashboard/upEpisodios.php'>";
        }

        if($_FILES['episodio']['size'] >= 1000000000){
            echo "<script>alert('Infelizmente os navegadores não suportam esse tamanho de arquivo para upload. Tente reduzir o tamanho o vídeo.');</script>";
            echo "<meta http-equiv='refresh' content='0, url=/dashboard/upEpisodios.php'>";
        }

        $anime = new Anime();
        $anime->id = $_POST['idObra'];
        $anime->fillAnime('usuario');

        $final = false;
        if($anime->numeroEpisodios != '??'){
            if(($anime->episodiosUpados() + 1) == $anime->numeroEpisodios){
                $final = true;
            }
        }

        $upouEpisodio;
        $upouThumb;

        if( !isset($_POST['cadastroCheck']) ){
            $diretorio = "/home/storage/c/29/18/anieclipse3/public_html/$anime->diretorio/";

            $tempThumb = $_FILES['thumb']['tmp_name']; 
            $finalThumb = $diretorio."img/thumb-".$_POST['numeroEpisodio'].".png";

            $tempEpisodio = $_FILES['episodio']['tmp_name'];
            $finalEpisodio = $diretorio."episodio-".$_POST['numeroEpisodio'].".mp4";

            $upouEpisodio = move_uploaded_file($tempEpisodio,$finalEpisodio);
            $upouThumb = move_uploaded_file($tempThumb,$finalThumb);
        }else {
            $upouEpisodio = TRUE;
            $upouThumb = TRUE;
        }

        if($upouEpisodio && $upouThumb){
            $novoEpisodio = new Episodio();

            $novoEpisodio->uploader             = $_POST['id'];
            $novoEpisodio->obra                 = $_POST['idObra'];
            $novoEpisodio->nome                 = $_POST['nomeEpisodio'];
            $novoEpisodio->numero               = $_POST['numeroEpisodio'];
            $novoEpisodio->duracao              = $_POST['duracaoEpisodio'];
            $novoEpisodio->thumb                = "thumb-".$_POST['numeroEpisodio'].".png";
            $novoEpisodio->nomeArquivo          = "episodio-".$_POST['numeroEpisodio'].".mp4";
            $novoEpisodio->qualidadeMax         = $_POST['qualidadeEpisodio'];
            $novoEpisodio->temporada            = $_POST['temporadaEpisodio'];
            $novoEpisodio->dataPostagem         = date('Y-m-d H:i:s');
            $novoEpisodio->views                = 0;

            $novoEpisodio->save($final);

            echo "<script>alert('Episódio upado com sucesso!');</script>";
            echo "<meta http-equiv='refresh' content='0, url=../dashboard'>";
        }

    }

?>