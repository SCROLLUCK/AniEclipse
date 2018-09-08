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

function main() {
    var contentBox = document.getElementById("box");
    var contentLISTA = document.getElementById("LISTA");

    if(contentBox != null){
        var xmlreq1 = CriaRequest();
        var UltimosEps;
        var contador = 0;
            
        xmlreq1.open("GET","php/episodio.php?temporada=atual",true);
            
        xmlreq1.onreadystatechange = function(){
                  
            if (xmlreq1.readyState == 4) {
                      
                if (xmlreq1.status == 200) {

                    UltimosEps = JSON.parse(xmlreq1.responseText);

                    html = "<ul id='TEMPORADA-ATUAL' class='TT'>";
                    
                    while(contador < UltimosEps.length){
                        html += "<div class='EP LANCA'>";
                        html += "<p class='tempo'>"+UltimosEps[contador].Duracao+"</p>";
                        //html += "<p class='final'>"+UltimosEps[contador].Final+"</p>";
                        html += "<a href='"+UltimosEps[contador].Diretorio+"/episodio.php?ep="+UltimosEps[contador].Numero+"' title='"+UltimosEps[contador].Nome+"'>";
                        html += "<img class='THUMB' src='"+UltimosEps[contador].Diretorio+"/"+UltimosEps[contador].Thumb+"'>";
                        html += "</a>";
                        html += "<div class='identifica'>";
                        html += "<a class='link-logo' href='"+UltimosEps[contador].Diretorio+"' title='"+UltimosEps[contador].Obra+"'>";
                        html += "<img class='logo-anime' src='"+UltimosEps[contador].Diretorio+"img/logo.png'>";
                        html += "</a>";
                        html += "<a href='"+UltimosEps[contador].Diretorio+"/episodio.php?ep="+UltimosEps[contador].Numero+"'>";
                        html += "<p class='episodio'>EPISODIO "+UltimosEps[contador].Numero+"</p>";
                        html += "<p class='anime'>"+UltimosEps[contador].Obra.toUpperCase()+"</p>";
                        html += "<p class='nomeEP'>"+UltimosEps[contador].Nome+"</p>";
                        html += "</a>";
                        html += "</div>";
                        html += "</div>";

                        contador = contador + 1;
                    }
                    
                    html += "</ul>";
                    
                    contentBox.innerHTML = html;

                }else{
                    contentBox.innerHTML = "Erro: " + xmlreq1.statusText;
                }
            }
        };
        xmlreq1.send(null);
    }

    if(contentLISTA != null){
        var xmlreq2 = CriaRequest();
        var ListaObras;
        var contador = 0;

        xmlreq2.open("GET","php/anime.php?pegaAnime=recentes",true);

        xmlreq2.onreadystatechange = function(){
            if(xmlreq2.readyState == 4){
                if(xmlreq2.status == 200){

                    ListaObras = JSON.parse(xmlreq2.responseText);

                    html = "";
                    
                    while(contador < ListaObras.length){
                        html += "<div class='Capsula'>";
                        html += "<div class='Anime'>";
                        html += "<div class='thumb-episodio' style='background: #1b1a1a url(../"+ListaObras[contador].Diretorio+"/img/"+ListaObras[contador].Capa+"); background-size: cover; background-position: center;'>";
                        html += "<div class='Info-anime'>";
                        html += "<p class='nome-anime'>"+ListaObras[contador].Nome+"</p>";
                        html += "<p class='info'><span class='name-info'>Lançamento: </span>"+ListaObras[contador].DataLancamento+"</p>";
                        html += "<p class='info'><span class='name-info'>Roteirista: </span>"+ListaObras[contador].Roteirista+"</p>";
                        html += "<p class='info'><span class='name-info'>Estudio: </span>"+ListaObras[contador].Estudio+"</p>";
                        html += "<p class='info'><span class='name-info'>Status: </span>"+ListaObras[contador].Status+"</p>";
                        html += "<p class='info' style='width:100%;'><span class='name-info'>Episódios: </span>"+ListaObras[contador].Episodios+" <a class='link-anime' href='../"+ListaObras[contador].Diretorio+"'>Assista Agora!</a></p>";
                        html += "<p class='Sinopse'>"+ListaObras[contador].Sinopse+"</p>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";

                        contador = contador + 1;
                    }
                    
                    contentLISTA.innerHTML = html;

                }else {
                    contentLISTA.innerHTML = "Erro: "+xmlreq2.statusText;
                }
            }
        };
        xmlreq2.send(null);
    }
}