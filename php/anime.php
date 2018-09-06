<?php

  $target="anime.php";
  if(basename($_SERVER["PHP_SELF"])== $target){
    die("<meta charset='utf-8'><title></title><script>window.location=('index.php')</script>");
  }
  
  include("obra.php");
  
  class Anime extends Obra{
    public $Fonte;
    public $ResponsavelFonte;
    public $OVAS;
    public $Especiais;
    
    public function altera($campo,$novoValor){
        $this->$campo = $valor;
    }
    
  }

?>