<?php

    $pathServer = "/home/storage/c/29/18/anieclipse3/public_html/";
    $pathDocker = "/home/lse/REPOS/AnieEclipse";

    if(file_exists($pathServer)){
        require_once($pathServer."/class/Usuario.php");
        require_once($pathServer."/class/Episodio.php");
        require_once($pathServer."/class/Animacao.php");
    }else {
        require_once($pathDocker."/class/Usuario.php");
        require_once($pathDocker."/class/Episodio.php");
        require_once($pathDocker."/class/Animacao.php");
    }

    $target="animacoes.php";
    $proprioArquivo = FALSE;
    if(basename($_SERVER["PHP_SELF"])== $target){
        $proprioArquivo = TRUE;
    }

    function comparadorObras2($obra1,$obra2){
        return strcmp($obra1->nome,$obra2->nome);
    }

    function listarTodosAnimacoes($metodo){
        if($metodo == 'quick'){
            try{
                $listaAnimacoesTotal = [];
                $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
                $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
                $resultAnimacao = $db->query("SELECT idObra, obras.nome, obras.diretorio, obras.capa, obras.sinopse FROM animacoes, obras WHERE obras.id = idObra ORDER BY obras.nome");
                while($rowAnimacao = $resultAnimacao->fetch(PDO::FETCH_OBJ)){
                    $animacaoAtual = new Animacao();
                    $animacaoAtual->fill($rowAnimacao);
                    $animacaoAtual->tipo = "Animação";

                    $listaAnimacoesTotal[] = $animacaoAtual;
                }

                unset($db);
                return $listaAnimacoesTotal;

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
        try{
            $listaAnimesRecentes = [];
            $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
            $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            $resultAnime = $db->query("SELECT idObra FROM animacoes WHERE status != 'Lançando' ORDER BY idObra DESC LIMIT 10");
            while($rowAnime = $resultAnime->fetch(PDO::FETCH_OBJ)){
                $animeAtual = new Animacao();
                $animeAtual->id = $rowAnime->idObra;
                $animeAtual->fillAnimacao('naoUsuario');

                $listaAnimesRecentes[] = $animeAtual;
            }

            unset($db);
            echo json_encode($listaAnimesRecentes);

        }catch(PDOException $exception){
            unset($db);
            echo $exception;
            die();
        }

    }

    if(isset($_GET['todos']) && $proprioArquivo){
        $listaAnimacoes = listarTodosAnimacoes('quick');
        echo json_encode($listaAnimacoes);
    }

?>