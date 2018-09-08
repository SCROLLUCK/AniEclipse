<?php
  
  include("conexaoAnieDB.php");
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

   if($_GET['pegaAnime']=="todos"){
    $resultAnimes = $mysqli->query("SELECT * FROM obras WHERE animacao = 0 ORDER BY nome");

    while($linhaAnimes = $resultAnimes->fetch_assoc()){
        $NovoAnime = new Anime($linhaAnimes['nome'],$linhaAnimes['episodios'],$linhaAnimes['temporadas'],$linhaAnimes['estreia'],$linhaAnimes['estudio'],$linhaAnimes['autor'],"",$linhaAnimes['background'],$linhaAnimes['capa'],$linhaAnimes['diretorio'],$linhaAnimes['lancamento'],$linhaAnimes['status']);
        $NovoAnime->Sinopse = $linhaAnimes['sinopse'];
        $ListaAnimes[] = $NovoAnime; 
    }

    echo json_encode($ListaAnimes);
  }

  if($_GET['pegaAnime']=="recentes"){
    $resultAnimes = $mysqli->query("SELECT * FROM obras WHERE animacao = 0 AND status = 'Completo' ORDER BY id DESC");

    while($linhaAnimes = $resultAnimes->fetch_assoc()){
        $NovoAnime = new Anime($linhaAnimes['nome'],$linhaAnimes['episodios'],$linhaAnimes['temporadas'],$linhaAnimes['estreia'],$linhaAnimes['estudio'],$linhaAnimes['autor'],"",$linhaAnimes['background'],$linhaAnimes['capa'],$linhaAnimes['diretorio'],$linhaAnimes['lancamento'],$linhaAnimes['status']);
        $NovoAnime->Sinopse = $linhaAnimes['sinopse'];
        $ListaAnimes[] = $NovoAnime; 
    }

    echo json_encode($ListaAnimes);
  }

?>