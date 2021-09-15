<?php
	//recebemos nosso parâmetro vindo do form
	$parametro = isset($_POST['pesquisaCliente']) ? $_POST['pesquisaCliente'] : null;
	$msg = "";
	//começamos a concatenar nossa tabela
	$msg .="<table style='min-width: 500px; background: rgba(0,0,0,0.7); border-radius: 7px;'>";
				
				//requerimos a classe de conexão
				require_once('class/Conexao.class.php');
					try {
						$pdo = new Conexao(); 
						$resultado = $pdo->select("SELECT * FROM animes WHERE nome LIKE '%$parametro%' OR genero1 LIKE '%$parametro%' OR genero2 LIKE '%$parametro%' OR autor LIKE '%$parametro%' OR estudio LIKE '%$parametro%' OR alt LIKE '%$parametro%' OR upload LIKE '%$parametro%' ORDER BY nome ASC");
						$pdo->desconectar();			
						}catch (PDOException $e){
							echo $e->getMessage();
						}	
						//resgata os dados na tabela
						if(count($resultado)){
							foreach ($resultado as $res) {
                            	$cor = "yellow";
                              	$aux = "";
								$compara = "Completo";
								if($res['status'] == $compara) { $cor = "#1bef1b";}
                              	if($res['status'] != $compara){ $aux = $res['upload'];}
                              
                        
                        $msg .="<div class='BACK_RESULTADOS' style='position: relative; min-height: 200px; background: url(../../../".$res['pasta']."/Imagens/".$res['background']."); background-size: 100%; '>";
                        $msg .=" <div class='INFOS_RESULTADOS'>";
						$msg .="    <a href='../../".$res['pasta']."' class='nomeBUSCA'> ".$res['nome']."</a>";
						$msg .="	<div class='subINFO'>";
						$msg .="    	<img style='width: 117px;height: auto;float: left;margin: 9px;position:  relative;bottom: 65px;' src='../../../".$res['pasta']."/Imagens/".$res['capa']."'>";
						$msg .="	   <p class='buscaP' style=' padding-top: 16px;'>Status: ".$res['status']."</p>";
						$msg .="       <p class='buscaP'>Ano: ".$res['lancamento']." </p>";
						$msg .="	   <p class='buscaP'>Mangaká: ".$res['autor']."</p>";
						$msg .="	   <p class='buscaP'>Generos: ".$res['genero1']." ".$res['genero2']." ".$res['genero3']." ".$res['genero4']."</p>";
						$msg .="       <p class='buscaP'>Episodios: ".$res['episodios']."</p>";
						$msg .="       <p style='color: #00fdff;font-family: arial; font-size: 14px; margin: 0; position: relative;'></p>";
						$msg .="	   <p class='qualidade_EPISODIO'>".$res['qualidade-max']."</p>";
						$msg .="	</div>";
						$msg .=" </div>";
						$msg .="</div>";
							}	
						}else{
							$msg = "";
							$msg .="<p style='background: rgba(0,0,0,0.7); padding: 2%;'>"."Anime não encontrado"."</p>";
						}
	$msg .="</table>";
	//retorna a msg concatenada
	echo $msg;
?>