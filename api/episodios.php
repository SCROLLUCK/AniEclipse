<?php
    include("apiauth.php");
    require_once("../class/Usuario.php");
    require_once("../class/Anime.php");
    require_once("../class/Episodio.php");


    $requestMethod = $_SERVER['REQUEST_METHOD'];

    if($requestMethod == 'GET'){
        if(apiauth($_GET['key'])){
            if($_GET['modo'] == "lancamentos"){
                try{
                    $listaEpisodios = [];
                    $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
                    $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
                    $resultAnime = $db->query("SELECT idObra FROM animes WHERE status = 'Lançando'");
                    while($rowAnime = $resultAnime->fetch(PDO::FETCH_OBJ)){
                        $animeAtual = new Anime();
                        $animeAtual->id = $rowAnime->idObra;
                        $animeAtual->fillAnime();
        
                        $resultEpisodio = $db->query("SELECT id FROM episodios WHERE idObra = '$animeAtual->id' ORDER BY id DESC LIMIT 1");
                        $rowEpisodio = $resultEpisodio->fetch(PDO::FETCH_OBJ);
        
                        $episodioAtual = new Episodio();
                        $episodioAtual->id = $rowEpisodio->id;
                        $episodioAtual->obra = $animeAtual;
                        $episodioAtual->fillEpisodio();
        
                        $listaEpisodios[] = $episodioAtual;
                    }
        
                    unset($db);
                    header("Content-Type: application/json");
                    echo json_encode($listaEpisodios);
        
                }catch(PDOException $exception){
                    unset($db);
                    echo $exception;
                    die();
                }
            }

        }else {
            header("HTTP/1.0 401 Acesso Negado");
        }

    }else if($requestMethod == 'POST'){

    }

?>