<?php

  $target="Animacao.php";
  if(basename($_SERVER["PHP_SELF"])== $target){
    die("<meta charset='utf-8'><title></title><script>window.location=('index.php')</script>");
  }
  
  require_once("Obra.php");
  
  class Animacao extends Obra{
    public $pilotos;
    public $especiais;
    public $status;
    public $uploader;


    public function fillAnimacao($user){
      try{
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        
        $resultObra = $db->query("SELECT * FROM obras WHERE id = '$this->id'");
        $rowObra = $resultObra->fetch(PDO::FETCH_OBJ);

        $this->idade                    = $rowObra->idade;
        $this->audio                    = $rowObra->audio;
        $this->nome                     = $rowObra->nome;
        $this->temporadaAtual           = $rowObra->temporadaAtual;
        $this->temporadaAnterior        = $rowObra->temporadaAnterior;
        $this->temporadaPosterior       = $rowObra->temporadaPosterior;
        $this->numeroEpisodios          = $rowObra->numeroEpisodios;
        $this->sinopse                  = $rowObra->sinopse;
        $this->numeroTemporadas         = $rowObra->numeroTemporadas;
        $this->estreia                  = $rowObra->estreia;
        $this->estudio                  = $rowObra->estudio;
        $this->roteirista               = $rowObra->roteirista;
        $this->site                     = $rowObra->site;
        $this->trailler                 = $rowObra->trailler;
        $this->background               = $rowObra->background;
        $this->capa                     = $rowObra->capa;
        $this->diretorio                = $rowObra->diretorio;
        $this->qualidadeMax             = $rowObra->qualidadeMax;
        $this->transmissao              = $rowObra->transmissao;
        $this->tipo                     = "Animação";
        $this->status                   = $rowObra->status;
        
        $resultAnimacao = $db->query("SELECT * FROM animacoes WHERE idObra = '$this->id'");
        $rowAnimacao = $resultAnimacao->fetch(PDO::FETCH_OBJ);
        
        $this->numeroPilotos = $rowAnimacao->numeroPilotos;

        if($user != 'usuario'){
          $userUp = new Usuario();
          $userUp->id = $rowAnimacao->idUsuario;
          $userUp->fillUsuario();
          $this->uploader = $userUp;
        }

        unset($db);
      }catch(PDOException $exception){
        unset($db);
        echo $exception;
        die();
      }
    }
    
  }

?>