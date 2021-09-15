<?php

    session_start();
    require_once("../class/Usuario.php");

    function listarUsuarios(){
        try{
            $listaUsers = [];
            $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
            $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            $resultUsuarios = $db->query("SELECT id FROM usuarios");
            while($rowUsuarios = $resultUsuarios->fetch(PDO::FETCH_OBJ)){
                $userAtual = new Usuario();
                $userAtual->id = $rowUsuarios->id;
                $userAtual->fillUsuario();

                $listaUsers[] = $userAtual;
            }

            unset($db);
            return $listaUsers;

        }catch (PDOException $exception){
            unset($db);
            echo $exception;
            die();
        }
    }

    if($_POST['op'] == 'like'){
        $userCurtiu = new Usuario();
        $userCurtido = new Usuario();
        $userCurtiu->id = $_POST['curtiu'];
        $userCurtido->id = $_POST['curtido'];

        $userCurtiu->curtir($userCurtido);

        echo "<meta http-equiv='refresh' content='0, url=/perfil.php?id=".$userCurtido->id."'>";
    }

    if($_POST['op'] == 'updatephoto'){

        $pathServer = "/home/storage/c/29/18/anieclipse3/public_html";
        $pathDocker = "/home/lse/REPOS/AnieEclipse";

        if(file_exists($pathServer)){
            $finalPhoto = $pathServer."/users/".$_FILES['userFoto']['name'];
        }else {
            $finalPhoto = $pathDocker."/users/".$_FILES['userFoto']['name'];
        }

        $tempPhoto = $_FILES['userFoto']['tmp_name'];

        $upouFoto = move_uploaded_file($tempPhoto,$finalPhoto);

        if($upouFoto){
            $user = new Usuario();
            $user->id = $_SESSION['usuarioLogado'];
            $user->perfil = "users/".$_FILES['userFoto']['name'];
            $user->updateFoto();

            echo "<script>alert('Foto atualizada com sucesso!');</script>";
            echo "<meta http-equiv='refresh' content='0, url=/perfil.php?id=".$user->id."'>";
        }else {
            echo "<script>alert('ocorreu uma falha ao upload');</script>";
            echo "<meta http-equiv='refresh' content='0, url=/perfil.php?id=".$user->id."'>";

        }
        
    }

?>