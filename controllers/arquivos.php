<?php

    require_once("../class/Usuario.php");

    if(isset($_GET['novoArquivo'])){
        $usuarioLog = new Usuario();
        $usuarioLog->nickname = $_POST['user'];
        $usuarioLog->setPasswd($_POST['senha']);

        if($usuarioLog->auth()){
            $diretorio = "/home/storage/c/29/18/anieclipse3/public_html/";

            $tempArquivo = $_FILES['arquivo']['tmp_name']; 
            $finalArquivo = $diretorio.$_POST['url']."/".$_FILES['arquivo']['name'];

            $upouArquivo = move_uploaded_file($tempArquivo,$finalArquivo);

            if($upouArquivo){
                echo "<script>alert('Arquivo upado com sucesso!');</script>";
                echo "<meta http-equiv='refresh' content='0, url=../dashboard'>";
            }else {
                echo "<script>alert('Erro ao fazer upload');</script>";
                echo "<meta http-equiv='refresh' content='0, url=../dashboard'>";
            }

        }
    }

?>