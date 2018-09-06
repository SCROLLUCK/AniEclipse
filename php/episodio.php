<?php
  
  include("conexaoAnieDB.php");

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
    public $DataPostagem;
    public $Views;
    
    public function __construct($ID,$Uploader,$Animacao,$Obra,$Nome,$Numero,$Duracao,$Thumb,$NomeArquivo,$QualidadeMax,$Temporada,$DataPostagem,$Views){
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
        $this->DataPostagem = $DataPostagem;
        $this->Views = $Views;
    }
    
    public function altera($campo,$novoValor){
        $this->$campo = $valor;
    }
    
  }

  if($_GET['temporada']=="atual"){
    $resultEpisodios = $mysqli->query("SELECT * FROM episodios WHERE animacao = 0 ORDER BY id DESC LIMIT 20");
    while($linhaEpisodios = $resultEpisodios->fetch_assoc()){
        $NovoEpisodio = new Episodio($linhaEpisodios['id'],$linhaEpisodios['uploader'],$linhaEpisodios['animacao'],$linhaEpisodios['obra'],$linhaEpisodios['nome'],$linhaEpisodios['numero'],$linhaEpisodios['duracao'],$linhaEpisodios['thumb'],$linhaEpisodios['nomeArquivo'],$linhaEpisodios['qualidadeMax'],$linhaEpisodios['temporada'],$linhaEpisodios['dataPostagem'],$linhaEpisodios['views']);
        $ListaEpisodios[] = $NovoEpisodio;
    }

    echo json_encode($ListaEpisodios);
  }

?>