<?php

  $target="Obra.php";
  if(basename($_SERVER["PHP_SELF"])== $target){
    die("<meta charset='utf-8'><title></title><script>window.location=('index.php')</script>");
  }
  
  class Obra{
    public $id;
    public $idade;
    public $audio;
    public $nome;
    public $nomeAlternativo;
    public $temporadaAnterior;
    public $temporadaAtual;
    public $temporadaPosterior;
    public $numeroEpisodios;
    public $sinopse;
    public $numeroTemporadas;
    public $estreia;
    public $estudio;
    public $roteirista;
    public $site;
    public $trailler;
    public $background;
    public $capa;
    public $diretorio;
    public $qualidadeMax;
    public $transmissao;
    public $tipo;

    public function episodiosUpados(){
      try{
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        $result = $db->query("SELECT id FROM episodios WHERE idObra = '$this->id'");

        $numero = $result->rowCount();
        unset($db);
        return $numero;
      }catch(PDOException $exception){
        unset($db);
        echo $exception;
        die();
      }
    }

    public function fillTemporadas($tipoObra){
      $obraAnterior = new Anime();
      $obraPosterior = new Anime();
      
      $obraAnterior->id = $this->temporadaAnterior;
      $obraPosterior->id = $this->temporadaPosterior;
      if($obraAnterior->id != 0){
        $obraAnterior->fillQuick();
        $this->temporadaAnterior = $obraAnterior;
      }else{
        $this->temporadaAnterior = NULL;
      }
      if($obraPosterior->id != 0){
        $obraPosterior->fillQuick();
        $this->temporadaPosterior = $obraPosterior;
      }else {
        $this->temporadaPosterior = NULL;
      }

    }

    public function listarGeneros(){
      
      try{
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

        
        $listaGenero = [];
        $resultGeneros = $db->query("SELECT generos.id, nome, tipo FROM generos, rObraGenero WHERE idObra = '$this->id' AND idGenero = generos.id");
        while($rowGeneros = $resultGeneros->fetch(PDO::FETCH_OBJ)){
          $generoAtual = new Genero();
          $generoAtual->fill($rowGeneros);

          $listaGenero[] = $generoAtual;
        }
        unset($db);
        return $listaGenero;
      }catch(PDOException $exception){
        unset($db);
        echo $exception;
        die();
      }
    }

    public function listarTemporadas(){
      
      try{
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

        
        $listaTemporadas = [];
        $resultTemporadas = $db->query("SELECT temporada FROM episodios WHERE idObra = '$this->id' GROUP BY temporada");
        while($rowTemporadas = $resultTemporadas->fetch(PDO::FETCH_BOTH)){
          $listaTemporadas[] = $rowTemporadas;
        }
        unset($db);
        return $listaTemporadas;
      }catch(PDOException $exception){
        unset($db);
        echo $exception;
        die();
      }
    }

    public function fill($resultQuery){
      
      $resultQuery->idObra ? $this->id = $resultQuery->idObra : $this->id = $resultQuery->id;

      $this->nome       = $resultQuery->nome;
      $this->diretorio  = $resultQuery->diretorio;
      $this->capa       = $resultQuery->capa;
      $this->sinopse    = $resultQuery->sinopse;
    }

    public function fillQuick(){

      try{
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

        $resultObra = $db->query("SELECT id, nome, diretorio, capa, sinopse FROM obras WHERE id = '$this->id'");
        $rowObra = $resultObra->fetch(PDO::FETCH_OBJ);

        $this->nome       = $rowObra->nome;
        $this->diretorio  = $rowObra->diretorio;
        $this->capa       = $rowObra->capa;
        $this->sinopse    = $rowObra->sinopse;

        unset($db);
      }catch(PDOException $exception){
        unset($db);
        echo $exception;
        die();
      }

    }

    public function novoGenero($genero){
      try{
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

        $resultGen = $db->query("INSERT INTO rObraGenero (idObra, idGenero) VALUES ('$this->id', '$genero->id')");

        unset($db);
      }catch(PDOException $exception){
        unset($db);
        echo $exception;
        die();
      }
    }

  }

?>