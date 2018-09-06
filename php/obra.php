<?php

  $target="obra.php";
  if(basename($_SERVER["PHP_SELF"])== $target){
    die("<meta charset='utf-8'><title></title><script>window.location=('index.php')</script>");
  }
  
  class Obra{
    public $ID;
    public $Idade;
    public $Responsavel;
    public $Audio;
    public $Nome;
    public $TemporadaAnterior;
    public $TemporadaAtual;
    public $TemporadaPosterior;
    public $Episodios;
    public $Sinopse;
    public $Temporadas;
    public $Filmes;
    public $DataLancamento;
    public $AnoLancamento;
    public $Status;
    public $Estudio;
    public $Roteirista;
    public $Site;
    public $Trailler;
    public $Generos;
    public $Background;
    public $Capa;
    public $Diretorio;
    
    public function __construct($Nome,$Episodios,$Temporadas,$DataLancamento,$Estudio,$Roteirista,$Generos,$Background,$Capa,$Diretorio,$AnoLancamento,$Status){
        $this->Nome = $Nome;
        $this->Episodios = $Episodios;
        $this->Temporadas = $Temporadas;
        $this->DataLancamento = $DataLancamento;
        $this->AnoLancamento = $AnoLancamento;
        $this->Estudio = $Estudio;
        $this->Roteirista = $Roteirista;
        $this->Generos = $Generos;
        $this->Background = $Background;
        $this->Capa = $Capa;
        $this->Diretorio = $Diretorio;
        $this->Status = $Status;
    }
    
  }

?>