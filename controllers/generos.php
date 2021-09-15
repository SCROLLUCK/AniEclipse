<?php
    $pathServer = "/home/storage/c/29/18/anieclipse3/public_html/";
	$pathDocker = "/home/lse/REPOS/AnieEclipse";

    if(file_exists($pathServer)){
        require_once($pathServer."/class/Anime.php");
        require_once($pathServer."/class/Genero.php");
    }else {
        require_once($pathDocker."/class/Anime.php");
        require_once($pathDocker."/class/Genero.php");
    }


    function listarGeneros(){
        try{
            $listaGeneros = [];
            $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
            $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    
            $resultGenero = $db->query("SELECT `idGenero`,generos.nome FROM `rObraGenero`,`generos` WHERE `rObraGenero`.`idGenero` = `generos`.`id` GROUP BY idGenero ORDER BY generos.nome");
            
            while($rowGenero = $resultGenero->fetch(PDO::FETCH_OBJ)){
                $novoGenero = new Genero();
                $novoGenero->id = $rowGenero->idGenero;
                $novoGenero->fillGenero();

                $listaGeneros[] = $novoGenero;
            }

            unset($db);
            return $listaGeneros;
        
        }catch(PDOException $exception){
            unset($db);
            echo $exception;
            die();
        }
    }

    function listarTodosGeneros(){
        try{
            $listaGeneros = [];
            $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
            $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

            $resultGenero = $db->query("SELECT id, nome FROM generos ORDER BY nome");
            while($rowGenero = $resultGenero->fetch(PDO::FETCH_OBJ)){
                $novoGenero = new Genero();
                $novoGenero->id = $rowGenero->id;
                $novoGenero->nome = $rowGenero->nome;

                $listaGeneros[] = $novoGenero;
            }

            unset($db);
            return $listaGeneros;

        }catch(PDOException $exception){
            unset($db);
            echo $exception;
            die();
        }
    }

    if(isset($_GET['generoObra'])){
        if(isset($_GET['id'])){
            $novoGenero = new Genero();
            $novoGenero->id = $_POST['genero'];
            
            $obra = new Anime();
            $obra->id = $_GET['id'];

            $obra->novoGenero($novoGenero);

            echo "<meta http-equiv='refresh' content='0, url=../dashboard/addGenero.php?id=$obra->id'>";

        }
    }

?>