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
    public $Diretorio;
    public $NomeArquivo;
    public $QualidadeMax;
    public $Temporada;
    public $DataPostagem;
    public $Views;
    
    public function __construct($ID,$Uploader,$Animacao,$Obra,$Nome,$Numero,$Duracao,$Thumb,$Diretorio,$NomeArquivo,$QualidadeMax,$Temporada,$DataPostagem,$Views){
        $this->ID = $ID;
        $this->Uploader = $Uploader;
        $this->Animacao = $Animacao;
        $this->Obra = $Obra;
        $this->Nome = $Nome;
        $this->Numero = $Numero;
        $this->Duracao = $Duracao;
        $this->Thumb = $Thumb;
        $this->Diretorio = $Diretorio;
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

    $resultAnimes = $mysqli->query("SELECT nome, diretorio FROM obras WHERE animacao = 0 AND status = 'Lançando' ORDER BY id DESC LIMIT 20");

    while($linhaAnimes = $resultAnimes->fetch_assoc()){

        $AnimeAtual = $linhaAnimes['nome'];

        $resultEpisodios = $mysqli->query("SELECT * FROM episodios WHERE obra = '$AnimeAtual' ORDER BY id DESC LIMIT 1");
        if($resultEpisodios->num_rows > 0){
            $linhaEpisodios = $resultEpisodios->fetch_assoc();
            $NovoEpisodio = new Episodio($linhaEpisodios['id'],$linhaEpisodios['uploader'],$linhaEpisodios['animacao'],$linhaEpisodios['obra'],$linhaEpisodios['nome'],$linhaEpisodios['numero'],$linhaEpisodios['duracao'],$linhaEpisodios['thumb'],$linhaAnimes['diretorio'],$linhaEpisodios['nomeArquivo'],$linhaEpisodios['qualidadeMax'],$linhaEpisodios['temporada'],$linhaEpisodios['dataPostagem'],$linhaEpisodios['views']);
            $ListaEpisodios[] = $NovoEpisodio;
        }
        
    }

    echo json_encode($ListaEpisodios);
  }

?>