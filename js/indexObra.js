$(function(){
    $('.parallax').each(function(){
        var $obj = $(this);
         
        $(window).scroll(function() {
            var yPos = -($(window).scrollTop() / $obj.data('speed'));			 
            var bgpos = '50% '+ yPos + 'px';			 
            $obj.css('background-position', bgpos );		 
        });
    });
});

function mostra(oque){
    var info = document.getElementsById('CONTENT-INFO');
    var trailler = document.getElementsById('CONTENT-TRAILLER');
    var botoes = document.getElementsByClassName('but');

    info.style.display = "none";
    trailler.style.display = "none";

    //1 = info
    //2 = trailler

    if(oque == 1){
        info.style.display = "block";
        trailler.style.display = "none";
        trailler.setAttribute('src','none');
        botoes[0].style.color = "black";
        botoes[0].style.background = "rgba(255,255,255,0.5)";
        botoes[1].style.color = "silver";
        botoes[1].style.background = "rgba(0,0,0,0.5)";
    }

    if(oque == 2){
        info.style.display = "none";
        trailler.style.display = "block";
        botoes[1].style.color = "black";
        botoes[1].style.background = "rgba(255,255,255,0.5)";
        botoes[0].style.color = "silver";
        botoes[0].style.background = "rgba(0,0,0,0.5)";
    }
}

function exibirEpisodios(idObra,diretorio,multiplaTemp){
    var videosContent = document.querySelector("#listaVideos");
    videosContent.innerHTML = "<div class='lds-css ng-scope'><div style='position: relative; float: left; left: 50%; transform: translateX(-50%);' class='lds-eclipse'><div></div></div></div>";
    var html = "";

    axios.get("http://localhost:8080/controllers/episodios.php?obra="+idObra)
        .then(function(response){
            response.data.forEach((item) => {
                html += "<div class='EP LANCA'>";
                multiplaTemp == 1 ? html += "<p class='temporadaInfo'>"+item.temporada+"ª temporada</p>" : html += "";

                html += "<p class='tempo'>"+item.duracao+"</p>";
                html += "<a class='LINK-EP' href='episodio.php?ep="+item.numero+"' title='"+item.nome+"'></a>";
                html += "<img class='THUMB' src='http://localhost:8080/"+diretorio+"/img/"+item.thumb+"'>";
                html += "<div class='identifica'>";
                html += "<a href='episodio.php?ep="+item.numero+"'>";
                html += "<p class='episodio'>EPISODIO "+item.numero+"</p>";
                html += "<p class='anime' style='text-transform: uppercase;'>"+item.obra.nome+"</p>";
                html += "<p class='nomeEP'>"+item.nome+"</p>";
                html += "</a>";
                html += "</div>";
                html += "</div>";
            });
            videosContent.innerHTML = html;
        })
        .catch(function(error){
            console.warn(error);
        });

}

function exibePorTemporada(idObra,temporada){
    var contentBox = document.querySelector("#listaVideos");
    contentBox.innerHTML = "<div class='lds-css ng-scope'><div style='position: relative; float: left; left: 50%; transform: translateX(-50%);' class='lds-eclipse'><div></div></div></div>";
       
        axios.get("http://localhost:8080/controllers/episodios.php?obra="+idObra+"&temporada="+temporada)
            .then(function(response){
                contentBox.innerHTML = "";
                html = "";
                response.data.forEach((item) => {
                    html += "<div class='EP LANCA'>";
                    html += "<p class='temporadaInfo'>"+item.temporada+"ª temporada</p>"
                    html += "<p class='tempo'>"+item.duracao+"</p>";
                    item.final ? html += "<p class='final'>FINAL</p>" : html += "";
                    html += "<a class='LINK-EP' href='episodio.php?ep="+item.numero+"' title='"+item.nome+"'></a>";
                    html += "<img class='THUMB' src='http://localhost:8080/"+item.diretorio+"/img/"+item.thumb+"'>";
                    html += "<div class='identifica'>";
                    html += "<a href='episodio.php?ep="+item.numero+"'>";
                    html += "<p class='episodio'>EPISODIO "+item.numero+"</p>";
                    html += "<p class='anime'>"+item.obra.nome.toUpperCase()+"</p>";
                    html += "<p class='nomeEP'>"+item.nome+"</p>";
                    html += "</a>";
                    html += "</div>";
                    html += "</div>";
                });
                contentBox.innerHTML = html;
            })
        .catch(function(error){
            console.warn(error);
        });
}