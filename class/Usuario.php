<?php
  $target="Usuario.php";
  if(basename($_SERVER["PHP_SELF"])== $target){
    die("<meta charset='utf-8'><title></title><script>window.location=('index.php')</script>");
  }

  class Usuario {
    public $id;
    public $nome;
    public $uploader;
    public $nickname;
    public $email;
    private $senha;
    public $perfil;
    public $background;
    public $dev;
    public $curtidas;
   
    
    public function auth(){
      try{
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        
        $retorno = false;
        $statement = $db->prepare("SELECT id, senha FROM usuarios WHERE BINARY login = :nickname");
        $statement->bindValue(':nickname',$this->nickname);
        $statement->execute();

        if($statement->rowCount() == 1) {
          $rowUser = $statement->fetch(PDO::FETCH_OBJ);
          if(password_verify($this->senha,$rowUser->senha)){
            $this->id = $rowUser->id;
            $retorno = true;
          }
        }

        unset($db);
        return $retorno;

      }catch(PDOException $exception){
        unset($db);
        echo $exception;
        die();
      }
    }

    public function save(){
      try{
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        $statement = $db->prepare("INSERT INTO usuarios (nome, up, login, senha, email, perfil, background, curtidas) VALUES (:nome, :up, :login, :senha, :email, :perfil, :background, :curtidas)");
        $statement->bindValue(':nome',$this->nome);
        $statement->bindValue(':up',$this->uploader);
        $statement->bindValue(':email',$this->email);
        $statement->bindValue(':login',$this->nickname);
        $statement->bindValue(':senha',$this->senha);
        $statement->bindValue(':perfil',$this->perfil);
        $statement->bindValue(':background',$this->background);
        $statement->bindValue(':curtidas',$this->curtidas);

        $retorno = $statement->execute();

        unset($db);

        return $retorno;

      }catch(PDOException $exception){
        unset($db);
        echo $exception->getMessage();
        die();
      }
    }

    public function setPasswd($senha){
      $this->senha = $senha;
    }

    public function fillUsuario(){
      try{
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        $resultUser = $db->query("SELECT * FROM usuarios WHERE id = '$this->id'");
        $rowUser = $resultUser->fetch(PDO::FETCH_OBJ);

        $this->nome         = $rowUser->nome;
        $this->uploader     = $rowUser->up;
        $this->nickname     = $rowUser->login;
        $this->email        = $rowUser->email;
        $this->perfil       = $rowUser->perfil;
        $this->background   = $rowUser->background;
        $this->nascimento   = $rowUser->nascimento;
        $this->dev          = FALSE;

        $resultDev = $db->query("SELECT id FROM devs WHERE nome = '$this->nickname'");
        $confirma = $resultDev->rowCount();

        if($confirma == 1){
          $this->dev = TRUE;
        }

        $resultCurtidas = $db->query("SELECT COUNT(id) FROM curtidas WHERE idCurtido = '$this->id'");
        $rowCurtidas = $resultCurtidas->fetch(PDO::FETCH_ASSOC);
        $this->curtidas = $rowCurtidas['COUNT(id)'];
        

        unset($db);
      }catch(PDOException $exception){
        unset($db);
        echo $exception;
        die();
      }
    }

    public function jaCurtiu($user){
      try{
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        $resultJaCurtiu = $db->query("SELECT id FROM curtidas WHERE idCurtiu = '$this->id' AND idCurtido = '$user->id'");
        $retorno = FALSE;
        if($resultJaCurtiu->rowCount() == 1){
          $retorno = TRUE;
        }
        unset($db);
        return $retorno;

      }catch (PDOException $exception){
        unset($db);
        echo $exception;
        die();
      }

    }

    public function curtir($user){
      try{
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        $resultCurtir = $db->query("INSERT INTO curtidas (idCurtiu, idCurtido) VALUES ('$this->id','$user->id')");

        unset($db);

      }catch(PDOException $exception){
        unset($db);
        echo $exception;
        die();
      }
    }

    public function episodiosUpados(){
      try{
        $listaEpisodiosUpados = [];
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        $resultEpisodios = $db->query("SELECT id, idObra, numero FROM episodios WHERE idUsuario = '$this->id' ORDER BY id DESC LIMIT 10");

        
        while($rowEpisodio = $resultEpisodios->fetch(PDO::FETCH_OBJ)){
          $animeAtual = new Anime();
          $animeAtual->id = $rowEpisodio->idObra;
          $resultTeste = $db->query("SELECT nome FROM obras WHERE id = '$animeAtual->id'");
          $rowTeste = $resultTeste->fetch(PDO::FETCH_OBJ);
          $animeAtual->nome = $rowTeste->nome;
          //$animeAtual->fillAnime('usuario');

          $episodioAtual = new Episodio();
          $episodioAtual->id = $rowEpisodio->id;
          $episodioAtual->obra = $animeAtual;
          $episodioAtual->numero = $rowEpisodio->numero;
          //$episodioAtual->fillEpisodio();

          $listaEpisodiosUpados[] = $episodioAtual;
        }
        
        unset($db);
        return $listaEpisodiosUpados;
      }catch(PDOException $exception){
        unset($db);
        echo $exception;
        die();
      }
    }

    public function animesResponsavel(){
      try{
        $listaAnimesResponsavel = [];
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        $resultAnimes = $db->query("SELECT animes.idObra FROM animes, obras WHERE animes.idUsuario = '$this->id' AND obras.upado = '0' AND animes.idObra = obras.id ORDER BY animes.idObra DESC");
        
        while($rowAnimes = $resultAnimes->fetch(PDO::FETCH_OBJ)){
          $animeAtual = $rowAnimes->idObra;
          $resultObra = $db->query("SELECT nome, numeroEpisodios FROM obras WHERE id = '$animeAtual'");
          $rowObra = $resultObra->fetch(PDO::FETCH_OBJ);
          
          $animeNovo = new Anime();
          $animeNovo->id = $animeAtual;
          $animeNovo->nome = $rowObra->nome;
          $animeNovo->numeroEpisodios = $rowObra->numeroEpisodios;

          $listaAnimesResponsavel[] = $animeNovo;
        }

        $resultAnimacoes = $db->query("SELECT animacoes.idObra FROM animacoes, obras WHERE animacoes.idUsuario = '$this->id' AND obras.upado = '0' AND animacoes.idObra = obras.id ORDER BY animacoes.idObra DESC");
        
        while($rowAnimacoes = $resultAnimacoes->fetch(PDO::FETCH_OBJ)){
          $animeAtual = $rowAnimacoes->idObra;
          $resultObra = $db->query("SELECT nome, numeroEpisodios FROM obras WHERE id = '$animeAtual'");
          $rowObra = $resultObra->fetch(PDO::FETCH_OBJ);
          
          $animeNovo = new Anime();
          $animeNovo->id = $animeAtual;
          $animeNovo->nome = $rowObra->nome;
          $animeNovo->numeroEpisodios = $rowObra->numeroEpisodios;

          $listaAnimesResponsavel[] = $animeNovo;
        }

        unset($db);
        return $listaAnimesResponsavel;

      }catch(PDOException $exception){
        unset($db);
        echo $exception;
        die();
      }
    }

    
    public function numeroEpisodiosUpados(){
      try{
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        $resultEpisodios = $db->query("SELECT id FROM episodios WHERE idUsuario = '$this->id'");

        $numero = $resultEpisodios->rowCount();
        unset($db);
        return $numero;
      }catch(PDOException $exception){
        unset($db);
        echo $exception;
        die();
      }
    }
    
    public function numeroAnimesResponsavel(){
      try{
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        $resultAnimes = $db->query("SELECT idObra FROM animes WHERE idUsuario = '$this->id'");

        $numero = $resultAnimes->rowCount();
        unset($db);
        return $numero;
      }catch(PDOException $exception){
        unset($db);
        echo $exception;
        die();
      }
    }

    public function listarNomeAnimes(){
      try {
        $listaAnimes = [];
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        $resultObras = $db->query("SELECT id, nome, numeroEpisodios FROM obras WHERE upado = '0'");
        while($rowObras = $resultObras->fetch(PDO::FETCH_OBJ)){
          $animeAtual = new Anime();
          $animeAtual->id = $rowObras->id;
          $animeAtual->nome = $rowObras->nome;
          $animeAtual->numeroEpisodios = $rowObras->numeroEpisodios;
          $listaAnimes[] = $animeAtual;
        }

        unset($db);
        return $listaAnimes;

      }catch (PDOException $exception){
        unset($db);
        echo $exception;
        die();
      }
    }

    public function updateFoto(){
      try{
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        $resultFoto = $db->query("UPDATE usuarios SET perfil = '$this->perfil' WHERE id = '$this->id'");
        
        unset($db);
      }catch(PDOException $exception){
        unset($db);
        echo $exception;
        die();
      }
    }

  }

?>