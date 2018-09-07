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

function temporadaAtual() {
    var contentBox = document.getElementById("box");

    if(contentBox != null){
        var xmlreq = CriaRequest();
        var UltimosEps;
        var contador = 0;
            
        xmlreq.open("GET","php/episodio.php?temporada=atual",true);
            
        xmlreq.onreadystatechange = function(){
                  
            if (xmlreq.readyState == 4) {
                      
                if (xmlreq.status == 200) {

                    UltimosEps = JSON.parse(xmlreq.responseText);

                    html = "<ul id='TEMPORADA-ATUAL' class='TT'>";
                    
                    while(contador < UltimosEps.length){
                        html += "<div class='EP LANCA'>";
                        html += "<p class='tempo'>"+UltimosEps[contador].Duracao+"</p>";
                        //html += "<p class='final'>"+UltimosEps[contador].Final+"</p>";
                        html += "<a href='"+UltimosEps[contador].Diretorio+"/"+UltimosEps[contador].NomeArquivo+"' title='"+UltimosEps[contador].Nome+"'>";
                        html += "<img class='THUMB' src='"+UltimosEps[contador].Diretorio+"/"+UltimosEps[contador].Thumb+"'>";
                        html += "</a>";
                        html += "<div class='identifica'>";
                        html += "<a class='link-logo' href='"+UltimosEps[contador].Diretorio+"' title='"+UltimosEps[contador].Obra+"'>";
                        html += "<img class='logo-anime' src='"+UltimosEps[contador].Diretorio+"img/logo.png'>";
                        html += "</a>";
                        html += "<a href='"+UltimosEps[contador].Diretorio+"/"+UltimosEps[contador].NomeArquivo+"'>";
                        html += "<p class='episodio'>EPISODIO "+UltimosEps[contador].Numero+"</p>";
                        html += "<p class='anime'>"+UltimosEps[contador].Obra.toUpperCase()+"</p>";
                        html += "<p class='nomeEP'>"+UltimosEps[contador].Nome.toUpperCase()+"</p>";
                        html += "</a>";
                        html += "</div>";
                        html += "</div>";

                        contador = contador + 1;
                    }
                    
                    html += "</ul>";
                    
                    contentBox.innerHTML = html;

                }else{
                    contentBox.innerHTML = "Erro: " + xmlreq.statusText;
                }
            }
        };
        xmlreq.send(null);
    }
}