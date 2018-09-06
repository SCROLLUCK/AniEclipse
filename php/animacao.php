<?php

  $target="animacao.php";
  if(basename($_SERVER["PHP_SELF"])== $target){
    die("<meta charset='utf-8'><title></title><script>window.location=('index.php')</script>");
  }
  
  include("obra.php");
  
  class Animacao extends Obra{
    public $Pilotos;
    public $Especiais;
    
    public function altera($campo,$novoValor){
        $this->$campo = $valor;
    }
    
  }

?>