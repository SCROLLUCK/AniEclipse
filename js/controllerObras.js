function CriaRequest() {
     try{
         request = new XMLHttpRequest();        
     }catch (IEAtual){
          
         try{
             request = new ActiveXObject("Msxml2.XMLHTTP");       
         }catch(IEAntigo){
          
             try{
                 request = new ActiveXObject("Microsoft.XMLHTTP");          
             }catch(falha){
                 request = false;
             }
         }
     }
      
     if (!request) 
         alert("Seu Navegador não suporta Ajax!");
     else
         return request;
}

function exibeAnimes(opcao) {
    var contentLista = document.getElementsByClassName("TodosAnimes");

    if(contentLista != null){
        var xmlreq = CriaRequest();
        var ListaAnimes;
        var contador = 0;
        var html = "";
        
        if(opcao == "animes"){
            xmlreq.open("GET","php/anime.php?pegaAnime=todos",true);
        }
            
        xmlreq.onreadystatechange = function(){
                  
            if (xmlreq.readyState == 4) {
                      
                if (xmlreq.status == 200) {

                    ListaAnimes = JSON.parse(xmlreq.responseText);
                    
                    while(contador < ListaAnimes.length){
                        html += "<div class='Anime'>";
                        html += "<p class='nome-anime'>"+ListaAnimes[contador].Nome+"</p>";
                        html += "<div class='thumb-episodio' style='background: #1b1a1a url(../"+ListaAnimes[contador].Diretorio+"/img/"+ListaAnimes[contador].Capa+"); background-size: cover; background-position: center;'>";
                        html += "<div class='Info-anime'>";
                        html += "<p class='info'><span class='name-info'>Lançamento: </span>"+ListaAnimes[contador].DataLancamento+"</p>";
                        html += "<p class='info'><span class='name-info'>Roteirista: </span>"+ListaAnimes[contador].Roteirista+"</p>";
                        html += "<p class='info'><span class='name-info'>Estudio: </span>"+ListaAnimes[contador].Estudio+"</p>";
                        html += "<p class='info'><span class='name-info'>Status: </span>"+ListaAnimes[contador].Status+"</p>";
                        html += "<p class='info'><span class='name-info'>Episódios: </span>"+ListaAnimes[contador].Episodios+"</p>";
                        html += "<a class='link-anime' href='../"+ListaAnimes[contador].Diretorio+"'>Assista Agora!</a>";
                        html += "<p class='Sinopse'>"+ListaAnimes[contador].Sinopse+"</p>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";

                        contador = contador + 1;
                    }
                    
                    contentLista[0].innerHTML = html;

                }else{
                    contentLista[0].innerHTML = "Erro: " + xmlreq.statusText;
                }
            }
        };
        xmlreq.send(null);
    }
}