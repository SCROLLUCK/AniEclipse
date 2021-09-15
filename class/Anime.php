<?php
  
  $target="Anime.php";
  if(basename($_SERVER["PHP_SELF"])== $target){
    die("<meta charset='utf-8'><title></title><script>window.location=('index.php')</script>");
  }

  require_once("Obra.php");
  
  class Anime extends Obra{
    public $fonte;
    public $uploader;
    public $responsavelFonte;
    public $numeroOvas;
    public $status;


    public function fillAnime($user){
      try{
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        
        $resultObra = $db->query("SELECT * FROM obras WHERE id = '$this->id'");
        $rowObra = $resultObra->fetch(PDO::FETCH_OBJ);

        $this->idade                    = $rowObra->idade;
        $this->audio                    = $rowObra->audio;
        $this->nome                     = $rowObra->nome;
        $this->nomeAlternativo          = $rowObra->nomeAlternativo;
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
        $this->tipo                     = "Anime";
        $this->status                   = $rowObra->status;
        
        $resultAnime = $db->query("SELECT * FROM animes WHERE idObra = '$this->id'");
        $rowAnime = $resultAnime->fetch(PDO::FETCH_OBJ);
        
        $this->fonte = $rowAnime->fonte;
        $this->responsavelFonte = $rowAnime->responsavelFonte;
        $this->numeroOvas = $rowAnime->numeroOvas;

        if($user != 'usuario'){
          $userUp = new Usuario();
          $userUp->id = $rowAnime->idUsuario;
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

    public function save(){
      try{
        $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

        $db->beginTransaction();

        $resultProxId = $db->query("SHOW TABLE STATUS LIKE 'obras'");
        $rowProxId = $resultProxId->fetch(PDO::FETCH_OBJ);
        $proxIdObra = $rowProxId->Auto_increment;
        
        $statementObra = $db->prepare("INSERT INTO obras (nome,idade,audio,nomeAlternativo,temporadaAnterior,temporadaPosterior,temporadaAtual,diretorio,capa,background,sinopse,numeroEpisodios,qualidadeMax,transmissao,numeroTemporadas,roteirista,estudio,site,trailler,estreia,status) VALUES (:nome,:idade,:audio,:nomeAlternativo,:temporadaAnterior,:temporadaPosterior,:temporadaAtual,:diretorio,:capa,:background,:sinopse,:numeroEpisodios,:qualidadeMax,:transmissao,:numeroTemporadas,:roteirista,:estudio,:site,:trailler,:estreia,:status)");
        $statementObra->bindValue(':nome',$this->nome);
        $statementObra->bindValue(':idade',$this->idade);
        $statementObra->bindValue(':audio',$this->audio);
        $statementObra->bindValue(':nomeAlternativo',$this->nomeAlternativo);
        $statementObra->bindValue(':temporadaAnterior',$this->temporadaAnterior);
        $statementObra->bindValue(':temporadaPosterior',$this->temporadaPosterior);
        $statementObra->bindValue(':temporadaAtual',$this->temporadaAtual);
        $statementObra->bindValue(':diretorio',$this->diretorio);
        $statementObra->bindValue(':capa',$this->capa);
        $statementObra->bindValue(':background',$this->background);
        $statementObra->bindValue(':sinopse',$this->sinopse);
        $statementObra->bindValue(':numeroEpisodios',$this->numeroEpisodios);
        $statementObra->bindValue(':qualidadeMax',$this->qualidadeMax);
        $statementObra->bindValue(':transmissao',$this->transmissao);
        $statementObra->bindValue(':numeroTemporadas',$this->numeroTemporadas);
        $statementObra->bindValue(':roteirista',$this->roteirista);
        $statementObra->bindValue(':estudio',$this->estudio);
        $statementObra->bindValue(':site',$this->site);
        $statementObra->bindValue(':trailler',$this->trailler);
        $statementObra->bindValue(':estreia',$this->estreia);
        $statementObra->bindValue(':status',$this->status);

        $statementAnime = $db->prepare("INSERT INTO animes (idObra, fonte, responsavelFonte, idUsuario, numeroOvas) VALUES (:idObra, :fonte, :responsavelFonte, :idUsuario, :numeroOvas)");
        $statementAnime->bindValue(':idObra',$proxIdObra);
        $statementAnime->bindValue(':fonte',$this->fonte);
        $statementAnime->bindValue(':responsavelFonte',$this->responsavelFonte);
        $statementAnime->bindValue(':idUsuario',$this->uploader);
        $statementAnime->bindValue(':numeroOvas',$this->numeroOvas);

        if($this->temporadaAnterior != 0){
          $statementAtualizaTemporada = $db->prepare("UPDATE obras SET temporadaPosterior = :proxIdObra WHERE id = :temporadaAnterior");
          $statementAtualizaTemporada->bindValue(':proxIdObra',$proxIdObra);
          $statementAtualizaTemporada->bindValue(':temporadaAnterior',$this->temporadaAnterior);
          $statementAtualizaTemporada->execute();

          $contador = $this->numeroTemporadas - 1;
          $auxiliar = $this->temporadaAnterior;
          while($contador > 0){
            $statementTemporadasAnteriores = $db->prepare("UPDATE obras SET numeroTemporadas = :numeroAtualizado WHERE id = :tempAnterior");
            $statementTemporadasAnteriores->bindValue(':numeroAtualizado',$this->numeroTemporadas);
            $statementTemporadasAnteriores->bindValue(':tempAnterior',$auxiliar);
            $statementTemporadasAnteriores->execute();

            $resultAuxiliar = $db->query("SELECT temporadaAnterior FROM obras WHERE id = '$auxiliar'");
            $rowAuxiliar = $resultAuxiliar->fetch(PDO::FETCH_OBJ);
            $auxiliar = $rowAuxiliar->temporadaAnterior;
            $contador = $contador - 1;
          }

        }

        $statementObra->execute();
        $statementAnime->execute();
        

        $db->commit();
        unset($db);

        $codigoEpTemplate;
        $codigoEpTemplate .= "<?php";
        $codigoEpTemplate .= "\n\$id = '".$proxIdObra."';";
        $codigoEpTemplate .= "\ninclude(\"../../includes/episodio-template.php\");";
        $codigoEpTemplate .= "\n?>";

        $codigoIndexTemplate;
        $codigoIndexTemplate .= "\n<?php";
        $codigoIndexTemplate .= "\n\$id = '".$proxIdObra."';";
        $codigoIndexTemplate .= "\ninclude(\"../../includes/obra-template.php\");";
        $codigoIndexTemplate .= "\n?>";

        $pasta = $this->diretorio;
        $codigoEp = file_put_contents("../$pasta/episodio.php",$codigoEpTemplate);
        $codigoIndex = file_put_contents("../$pasta/index.php",$codigoIndexTemplate);

        if(!$codigoEp || !$codigoIndex){
          echo "Falha em gravar arquivos";
          die();
        }

      }catch(PDOException $exception){
        $db->rollback();
        unset($db);
        echo $exception;
        die();
      }
    }
    
  }

?>