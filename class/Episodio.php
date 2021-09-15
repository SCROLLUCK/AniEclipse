<?php
  $target="Episodio.php";
  if(basename($_SERVER["PHP_SELF"])== $target){
    die("<meta charset='utf-8'><title></title><script>window.location=('/')</script>");
  }

  class Episodio {
    public $id;
    public $uploader;
    public $obra;
    public $nome;
    public $numero;
    public $duracao;
    public $thumb;
    public $nomeArquivo;
    public $qualidadeMax;
    public $temporada;
    public $dataPostagem;
    public $views;
    public $final;
   
    
    public function fillEpisodio(){
      
      try{
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

        $resultEpisodio = $db->query("SELECT * FROM episodios WHERE id = '$this->id'");
        $rowEpisodio = $resultEpisodio->fetch(PDO::FETCH_OBJ);
        
        $this->uploader     = $this->obra->uploader;
        $this->nome         = $rowEpisodio->nome;
        $this->numero       = $rowEpisodio->numero;
        $this->duracao      = $rowEpisodio->duracao;
        $this->thumb        = $rowEpisodio->thumb;
        $this->nomeArquivo  = $rowEpisodio->nomeArquivo;
        $this->qualidadeMax = $rowEpisodio->qualidadeMax;
        $this->temporada    = $rowEpisodio->temporada;
        $this->dataPostagem = $rowEpisodio->dataPostagem;
        $this->views        = $rowEpisodio->views;

        unset($db);

      }catch(PDOException $exception){
        unset($db);
        echo $exception;
        die();
      }
    
    }

    public function fill($resultQuery){
      $this->id       = $resultQuery->id;
      $this->nome     = $resultQuery->nome;
      $this->numero   = $resultQuery->numero;
      $this->thumb    = $resultQuery->thumb;
      $this->duracao  = $resultQuery->duracao;
      $this->dataPostagem = $resultQuery->dataPostagem;
    }

    public function carregaEpisodio($numero){
      try{
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
      
        $idObra = $this->obra->id;
        $resultEpisodio = $db->query("SELECT id FROM episodios WHERE idObra = '$idObra' AND numero = '$numero'");
        $rowEpisodio = $resultEpisodio->fetch(PDO::FETCH_OBJ);

        $this->id = $rowEpisodio->id;
        
        unset($db);
      }catch(PDOException $exception){
        unset($db);
        echo $exception;
        die();
      }
    }

    public function save($final){
      try{
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        
        if(!$final){
          $statement = $db->prepare("INSERT INTO episodios (idUsuario,idObra,nome,numero,duracao,thumb,nomeArquivo,qualidadeMax,temporada,dataPostagem,views) VALUES (:idUsuario,:idObra,:nome,:numero,:duracao,:thumb,:nomeArquivo,:qualidadeMax,:temporada,:dataPostagem,:views)");
          $statement->bindValue(':idUsuario',$this->uploader);
          $statement->bindValue(':idObra',$this->obra);
          $statement->bindValue(':nome',$this->nome);
          $statement->bindValue(':numero',$this->numero);
          $statement->bindValue(':duracao',$this->duracao);
          $statement->bindValue(':thumb',$this->thumb);
          $statement->bindValue(':nomeArquivo',$this->nomeArquivo);
          $statement->bindValue(':qualidadeMax',$this->qualidadeMax);
          $statement->bindValue(':temporada',$this->temporada);
          $statement->bindValue(':dataPostagem',$this->dataPostagem);
          $statement->bindValue(':views',$this->views);

          $statement->execute();
        }else {
          $db->beginTransaction();

          $statement = $db->prepare("INSERT INTO episodios (idUsuario,idObra,nome,numero,duracao,thumb,nomeArquivo,qualidadeMax,temporada,dataPostagem,views) VALUES (:idUsuario,:idObra,:nome,:numero,:duracao,:thumb,:nomeArquivo,:qualidadeMax,:temporada,:dataPostagem,:views)");
          $statement->bindValue(':idUsuario',$this->uploader);
          $statement->bindValue(':idObra',$this->obra);
          $statement->bindValue(':nome',$this->nome);
          $statement->bindValue(':numero',$this->numero);
          $statement->bindValue(':duracao',$this->duracao);
          $statement->bindValue(':thumb',$this->thumb);
          $statement->bindValue(':nomeArquivo',$this->nomeArquivo);
          $statement->bindValue(':qualidadeMax',$this->qualidadeMax);
          $statement->bindValue(':temporada',$this->temporada);
          $statement->bindValue(':dataPostagem',$this->dataPostagem);
          $statement->bindValue(':views',$this->views);

          $statement2 = $db->prepare("UPDATE obras SET status = :status, upado = :upado WHERE id = :idObra");
          $statement2->bindValue(':status','Completo');
          $statement2->bindValue(':upado','1');
          $statement2->bindValue(':idObra',$this->obra);

          $statement->execute();
          $statement2->execute();

          $db->commit();
        }

        unset($db);

      }catch(PDOException $exception){
        $db->rollback();
        unset($db);
        echo $exception;
        die();
      }
    }

  }

?>