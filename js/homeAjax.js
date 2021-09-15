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
function mostraInfoAnime(ref){
    var INFOS = document.getElementsByClassName("Info-anime");
    var I = document.getElementsByClassName("INFo");
    var Nome_anime = document.getElementsByClassName("nome-anime");
    var index_data = ref.getAttribute("data-index");

    if(ref.getAttribute("data-show") == 0){
        for(var i = 0;i < INFOS.length; i++){
            INFOS[i].style = "";
            I[i].setAttribute("data-show",0);
            Nome_anime[i].style = "";
        }
        INFOS[index_data].style = "right:0%";
        ref.setAttribute("data-show",1);
        Nome_anime[index_data].style = "top: 4% ;bottom: initial !important;";
    }else{
        INFOS[index_data].style = "";
        ref.setAttribute("data-show",0);
        Nome_anime[index_data].style = "";
    }
}

function getTempoPostagem(data){

    var today=new Date(); 
    var dataPublicacao = new Date(data);
    var timeDiff = Math.abs(today.getTime() - dataPublicacao.getTime());
    var duration = Math.ceil(timeDiff / (1000));

    var dia = 60*60*24; // segundos correspondentes a um dia
    var d = parseInt(duration/dia);
    var w = parseInt(d/7);
    var mes = parseInt(w/4);
    var h = parseInt(duration / 3600);
    var m = parseInt(duration % 3600 / 60);
    var s = parseInt(duration % 3600 % 60);
    var ano = mes/12;

    if(ano > 0){
        result = (Math.round(ano));
        result += ano > 1 ? " anos atrás" : " ano atrás";
        return result;
    }else if (mes > 0){
        return (mes > 1 ? mes+" meses atrás" : mes+" mês atrás");
    }

    if(w > 0){
      return (w > 1 ? w+" semanas atrás" : w+" semana atrás");
    }

    if(d > 0){
      return (d > 1 ? d+" dias atrás" : d+" dia atrás");
    }

    if(h > 0){
      return (h > 1 ? h+" horas atrás" : h+" hora atrás");
    }

    if(m > 0){
      return (m > 1 ? m+" minutos atrás" : m+" minuto atrás");
    }else{
      return (s > 1 ? s+" segundos atrás" : s+" segundo atrás");
    }
}

function atualizaDatas(){

    var datasPostagens = document.getElementsByClassName("dataPostagem");
    
    if(datasPostagens){
      for(var i= 0; i < datasPostagens.length; i++){
        datasPostagens[i].innerHTML= " - "+getTempoPostagem(datasPostagens[i].getAttribute('data-postagem'));
      }
    }
    setTimeout('atualizaDatas()',10000);
}

function main() {
   var contentBox = document.querySelector("#box");
   var contentLISTA = document.querySelector("#LISTA");
   var htmlBox = "<ul id='TEMPORADA-ATUAL' class='TT'>";
   var htmlLista = "";

   if(contentBox != null){
       axios.get('http://localhost:8080/controllers/episodios.php?lancamentos')
            .then(function(response){
                response.data.forEach((item) => {
                    htmlBox += "<div class='EP LANCA'>";
                    htmlBox += "<p class='tempo'>"+item.duracao+"</p>";
                    item.final ? htmlBox += "<p class='final'>FINAL</p>" : htmlBox += "";
                    htmlBox += "<a class='LINK-EP' href='http://localhost:8080/"+item.obra.diretorio+"/episodio.php?ep="+item.numero+"' title='"+item.nome+"'></a>";
                    htmlBox += "<img class='THUMB' src='http://localhost:8080/"+item.obra.diretorio+"/img/"+item.thumb+"'>";
                    htmlBox += "<div class='identifica'>";
                    htmlBox += "<a class='link-logo' href='http://localhost:8080/"+item.obra.diretorio+"' title='"+item.obra.nome+"'>";
                    htmlBox += "<img class='logo-anime' src='http://localhost:8080/"+item.obra.diretorio+"/img/logo.png'>";
                    htmlBox += "</a>";
                    htmlBox += "<a href='http://localhost:8080/"+item.obra.diretorio+"/episodio.php?ep="+item.numero+"'>";
                    htmlBox += "<p class='episodio'>EPISODIO "+item.numero+" <span class='dataPostagem' data-postagem='"+item.dataPostagem+"'> - "+getTempoPostagem(item.dataPostagem)+"</span></p>";
                    htmlBox += "<p class='anime'>"+item.obra.nome.toUpperCase()+"</p>";
                    htmlBox += "<p class='nomeEP'>"+item.nome+"</p>";
                    htmlBox += "</a>";
                    htmlBox += "</div>";
                    htmlBox += "</div>";
                });
                htmlBox += "</ul>";
                contentBox.innerHTML = htmlBox;
            })
            .catch(function(error){
                console.warn(error);
            });

   }

   if(contentLISTA != null){
        axios.get('http://localhost:8080/controllers/animes.php?recentes')
            .then(function(response){
                response.data.forEach((item, index) => {
                    htmlLista += "<div class='Capsula'>";
                    htmlLista += "<div class='Anime'>";
                    htmlLista += "<a href='http://localhost:8080/"+item.diretorio+"' class='linkcapa' title='"+item.nome+"'></a>"
                    htmlLista += "<div class='thumb-episodio' style='background: #1b1a1a url(http://localhost:8080/"+item.diretorio+"/img/"+item.capa+"); background-size: cover; background-position: center;'>";
                    htmlLista += "<p class='nome-anime'>"+item.nome+"<i class='fa fa-info-circle INFo' data-index='"+index+"' data-show='0' aria-hidden='true' onclick='mostraInfoAnime(this);'></i></p>";
                    htmlLista += "<div class='Info-anime'>";
                    htmlLista += "<p class='Sinopse'><span class='name-info'>Sinopse: </span>"+item.sinopse+"</p>";
                    htmlLista += "<a class='link-anime' href='http://localhost:8080/"+item.diretorio+"'>Assista Agora!</a>";
                    htmlLista += "</div>";
                    htmlLista += "</div>";
                    htmlLista += "</div>";
                    htmlLista += "</div>";
                });
                contentLISTA.innerHTML = htmlLista;
            })
            .catch(function(error){
                console.warn(error);
            });   
   }
}