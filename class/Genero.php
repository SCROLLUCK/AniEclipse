<?php
  $target="Genero.php";
  if(basename($_SERVER["PHP_SELF"])== $target){
    die("<meta charset='utf-8'><title></title><script>window.location=('/')</script>");
  }

  class Genero {
    public $id;
    public $nome;
    public $tipo;
   
    
    public function fillGenero(){
      
      try{
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

        $resultGenero = $db->query("SELECT * FROM generos WHERE id = '$this->id' ORDER BY nome");
        $rowGenero = $resultGenero->fetch(PDO::FETCH_OBJ);
        
        $this->nome = $rowGenero->nome;
        $this->tipo = $rowGenero->tipo;

        unset($db);

      }catch(PDOException $exception){
        unset($db);
        echo $exception;
        die();
      }
    
    }

    public function fill($resultQuery){
      $this->id   = $resultQuery->id;
      $this->nome = $resultQuery->nome;
      $this->tipo = $resultQuery->tipo;
    }

  }

?>