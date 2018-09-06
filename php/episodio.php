<?php

  $target="anime.php";
  if(basename($_SERVER["PHP_SELF"])== $target){
    die("<meta charset='utf-8'><title></title><script>window.location=('index.php')</script>");
  }
  
  
  class Episodio {
    public $ID;
    public $Uploader;
    public $Animacao;
    public $Obra;
    public $Nome;
    public $Numero;
    public $Duracao;
    public $Thumb;
    public $NomeArquivo;
    public $QualidadeMax;
    public $Temporada;
    public $Status;
    public $DataPostagem;
    public $Views;
    
    public function __construct($ID,$Uploader,$Animacao,$Obra,$Nome,$Numero,$Duracao,$Thumb,$NomeArquivo,$QualidadeMax,$Temporada,$Status,$DataPostagem){
        $this->ID = $ID;
        $this->Uploader = $Uploader;
        $this->Animacao = $Animacao;
        $this->Obra = $Obra;
        $this->Nome = $Nome;
        $this->Numero = $Numero;
        $this->Duracao = $Duracao;
        $this->Thumb = $Thumb;
        $this->NomeArquivo = $NomeArquivo;
        $this->QualidadeMax = $QualidadeMax;
        $this->Temporada = $Temporada;
        $this->Status = $Status;
        $this->DataPostagem = $DataPostagem;
    }
    
    public function altera($campo,$novoValor){
        $this->$campo = $valor;
    }
    
  }

?>