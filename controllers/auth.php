<?php
    session_start();
    require_once("../class/Usuario.php");

    if(isset($_POST['nickname']) && isset($_POST['senha']) && ($_POST['op'] == 'login')){
        $supostoUsuario = new Usuario();
        $supostoUsuario->nickname = $_POST['nickname'];
        $supostoUsuario->setPasswd($_POST['senha']);

        if($supostoUsuario->auth()){
            $_SESSION['usuarioLogado'] = $supostoUsuario->id;
            echo "<meta http-equiv='refresh' content='0, url=../../'>";
        }else {
            echo "<script>alert('Não foi possível fazer o login!')</script>";
            echo "<meta http-equiv='refresh' content='0, url=../../login.php'>";
            die();
        }
    }

    if($_POST['op'] == 'cadastro'){
        $novoUsuario = new Usuario();
        
        $novoUsuario->nome          = $_POST['nome'];
        $novoUsuario->uploader      = 0;
        $novoUsuario->nickname      = $_POST['nickname'];
        $novoUsuario->email         = $_POST['email'];
        $novoUsuario->perfil        = "users/default.jpg";
        $novoUsuario->background    = "animes/shingeki-no-kyojin-2/img/shingeki2.jpg";
        $novoUsuario->curtidas      = 0;
        $novoUsuario->dev           = FALSE;

        $novoUsuario->setPasswd(password_hash($_POST['senha'],PASSWORD_DEFAULT));

        if($novoUsuario->save()){
            echo "<script>alert('Usuário criado com sucesso!')</script>";
            echo "<meta http-equiv='refresh' content='0, url=../../login.php'>";
        }else {
            echo "<script>alert('Não foi possível criar esse usuário')</script>";
            echo "<meta http-equiv='refresh' content='0, url=../../login.php'>";
        }
    }

?>