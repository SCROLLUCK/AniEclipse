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
   var contentBox = document.getElementById("boxObras");

   if(contentBox != null){
       var xmlreq1 = CriaRequest();
       var UltimosEps;
       var contador = 0;
           
       xmlreq1.open("GET","../controllers/animacoes.php?todos",true);
           
       xmlreq1.onreadystatechange = function(){
                 
           if (xmlreq1.readyState == 4) {
                     
               if (xmlreq1.status == 200) {

                   UltimosEps = JSON.parse(xmlreq1.responseText);

                   html = "";
                   
                   while(contador < UltimosEps.length){
                       html += "<div class='Anime'>";
                       html += "<p class='nome-anime'>"+UltimosEps[contador].nome+"</p>";
                       html += "<div class='thumb-episodio' style='background: #1b1a1a url(../"+UltimosEps[contador].diretorio+"/img/"+UltimosEps[contador].capa+"); background-size: cover; background-position-x: center;'>";
                       html += "<div class='Info-anime'>";
                       html += "<p class='info'> <span class='name-info'>Estreia: </span>"+UltimosEps[contador].estreia+" </p>";
                       html += "<p class='info'> <span class='name-info'>Roteirista: </span>"+UltimosEps[contador].roteirista+" </p>";
                       html += "<p class='info'> <span class='name-info'>Estudio: </span>"+UltimosEps[contador].estudio+" </p>";
                       html += "<p class='info'> <span class='name-info'>Status: </span>"+UltimosEps[contador].status+" </p>";
                       html += "<p class='info'> <span class='name-info'>Episodios: </span>"+UltimosEps[contador].numeroEpisodios+" </p>";
                       html += "<a class='link-anime' style='top: 13%;' href='../"+UltimosEps[contador].diretorio+"'> Assista agora!</a>";
                       html += "<p class='Sinopse'>";
                       html += "<span class='name-info'>Sinopse: </span> "+UltimosEps[contador].sinopse;
                       html += "</p>"
                       html += "</div>";
                       html += "</div>";
                       html += "</div>";

                       contador = contador + 1;
                   }
                   
                   contentBox.innerHTML = html;

               }else{
                   contentBox.innerHTML = "Erro: " + xmlreq1.statusText;
               }
           }
       };
       xmlreq1.send(null);
   }

}