<?php
   echo "<script> var resultadosP = document.getElementsByClassName('resultados'); resultadosP[0].style.display = 'block';</script>";
	//recebemos nosso parâmetro vindo do form
	$parametro = isset($_POST['pesquisaCliente']) ? $_POST['pesquisaCliente'] : null;
	$retornoBusca = "";
	//começamos a concatenar nossa tabela
	$retornoBusca .="<table style='min-width: 500px; background: rgba(0,0,0,0.7); border-radius: 7px;'>";
				
    //QUERY DE BUSCA
    $db = new PDO("mysql:host=127.0.0.1; dbname=aniedb;charset=utf8", "aniedb", "starred1234");
    $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    $statementBusca = $db->prepare("SELECT id, nome, estreia, roteirista, numeroEpisodios, qualidadeMax, diretorio, capa, background FROM obras WHERE nome LIKE :parametro OR nomeAlternativo LIKE :parametro ORDER BY nome ASC");
    $parametro = "%".$parametro."%";
    $statementBusca->bindValue(':parametro',$parametro);
    $statementBusca->execute();
	//resgata os dados na tabela
    if($statementBusca->rowCount() > 0){
        while($rowBusca = $statementBusca->fetch(PDO::FETCH_OBJ)) {
            $retornoBusca .="<div class='BACK_RESULTADOS' style='position: relative; background: url(../../".$rowBusca->diretorio."/img/".$rowBusca->background."); background-size: 100%; background-position-y:25%'>";
            $retornoBusca .=" <div class='INFOS_RESULTADOS'>";
            $retornoBusca .="<a class='LINK-BB' href='../../".$rowBusca->diretorio."'>";
            $retornoBusca .="	<div class='subINFO'>";
            $retornoBusca .="    	<img class='buscaIMG' src='../../../".$rowBusca->diretorio."/img/".$rowBusca->capa."'>";
            $retornoBusca .="       <div class='CapsulaP'>";
            $retornoBusca .="           <p class='buscaP'> ".$rowBusca->nome."</p>";
            $retornoBusca .="           <p class='buscaP'>Ano: ".$rowBusca->estreia." </p>";
            $retornoBusca .="	       <p class='buscaP'>Mangaká: ".$rowBusca->roteirista."</p>";
            $retornoBusca .="           <p class='buscaP'>Episodios: ".$rowBusca->numeroEpisodios."</p>";
            $retornoBusca .="           <p style='color: #00fdff;font-family: arial; font-size: 14px; margin: 0;position: relative;'></p>";
            $retornoBusca .="	       <p class='qualidade_EPISODIO'>".$rowBusca->qualidadeMax."</p>";
            $retornoBusca .="       </div>";
            $retornoBusca .="	</div>";
            $retornoBusca .="</a>";
            $retornoBusca .=" </div>";
            $retornoBusca .="</div>";
        }	
    }else{
        $retornoBusca = "";
        $retornoBusca .="<p class='N-ENCONTRADO'>"."Busca por <span class='enfase'>".$parametro."</span> não retornou dados!</p>";
    }
    $retornoBusca .="</table>";
    
	//retorna a msg concatenada
	echo $retornoBusca;
?>	