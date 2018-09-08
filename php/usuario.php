<?php
  session_start();
  include("conexaoAnieDB.php");

  class Usuario {
    public $ID;
    public $Nome;
    public $Uploader;
    public $Nickname;
    public $Email;
    public $Perfil;
    public $Background;
    public $Nascimento;
    public $Genero;
    public $Cidade;
    public $Estado;
    public $Privilegios;
    
    public function __construct($ID,$Nome,$Uploader,$Nickname,$Email,$Perfil,$Background,$Nascimento,$Cidade,$Estado,$Privilegios){
        $this->ID = $ID;
        $this->Nome = $Nome;
        $this->Uploader = $Uploader;
        $this->Nickname = $Nickname;
        $this->Email = $Email;
        $this->Perfil = $Perfil;
        $this->Background = $Background;
        $this->Nascimento = $Nascimento;
        $this->Cidade = $Cidade;
        $this->Estado = $Estado;
        $this->Privilegios = $Privilegios;
    }
    
    public function altera($campo,$novoValor){
        $this->$campo = $valor;
    }
    
  }

  if($_POST['funcao']=="logar"){
    $PossivelNick = $_POST['nickname'];
    $PossivelSenha = md5($_POST['senha']);

    $resultPossivelUsuario = $mysqli->query("SELECT * FROM usuarios WHERE BINARY login = '$PossivelNick' AND BINARY senha = '$PossivelSenha'");

    if($resultPossivelUsuario->num_rows == 1){
        $linhaUsuario = $resultPossivelUsuario->fetch_assoc();
        $UsuarioLogado = new Usuario($linhaUsuario['id'],$linhaUsuario['nome'],$linhaUsuario['up'],$linhaUsuario['login'],$linhaUsuario['email'],$linhaUsuario['perfil'],$linhaUsuario['background'],$linhaUsuario['nascimento'],$linhaUsuario['cidade'],$linhaUsuario['estado'],$linhaUsuario['privilegios']);
        $UsuarioLogado->Genero = $linhaUsuario['genero'];

        $_SESSION['UsuarioLogado'] = serialize($UsuarioLogado);
        echo "<meta http-equiv='refresh' content='0,url=/home.php'>";
    }else{
        echo "<script>alert('Não foi possível fazer login');</script>";
        echo "<meta http-equiv='refresh' content='0,url=/login.php'>";
    }
  }

?>