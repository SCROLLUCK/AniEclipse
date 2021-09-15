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

function main() {
   var contentBox = document.querySelector('#boxObras');

   if(contentBox != null){
       var html = "";
       axios.get('http://localhost:8080/controllers/animes.php?todos')
            .then(function(response){
                response.data.forEach((item, index) => {
                    html += "<div class='Anime'>";
                    html += "<a class='linkcapa' href='http://localhost:8080/"+item.diretorio+"'></a>";
                    html += "<div class='thumb-episodio' style='background: #1b1a1a url(http://localhost:8080/"+item.diretorio+"/img/"+item.capa+"); background-size: cover; background-position-x: center;'>";
                    html += "<p class='nome-anime'>"+item.nome+"<i class='fa fa-info-circle INFo' data-index='"+index+"' data-show='0' aria-hidden='true' onclick='mostraInfoAnime(this);'></i></p>";
                    html += "<div class='Info-anime'>";
                    html += "<p class='Sinopse'><span class='name-info'>Sinopse: </span> "+item.sinopse +"</p>";
                    html += "<a class='link-anime' href='http://localhost:8080/"+item.diretorio+"'> Assista agora!</a>";
                    html += "</div>";
                    html += "</div>";
                    html += "</div>";
                });
                contentBox.innerHTML = html;
            })
            .catch(function(error){
                console.warn(error);
            });
   }

}

function animesGenero(idGenero){
    var contentBox = document.querySelector("#boxObras");
    var html = "";

    if(contentBox != null){

        axios.get("http://localhost:8080/controllers/animes.php?gen="+idGenero)
            .then(function (response) {
                response.data.forEach((item, index) => {
                    html += "<div class='Anime'>";
                    html += "<a class='linkcapa' href='../"+item.diretorio+"'></a>";
                    html += "<div class='thumb-episodio' style='background: #1b1a1a url(../"+item.diretorio+"/img/"+item.capa+"); background-size: cover; background-position-x: center;'>";
                    html += "<p class='nome-anime'>"+item.nome+"<i class='fa fa-info-circle INFo' data-index='"+index+"' data-show='0' aria-hidden='true' onclick='mostraInfoAnime(this);'></i></p>";
                    html += "<div class='Info-anime'>";
                    html += "<p class='Sinopse'><span class='name-info'>Sinopse: </span> "+item.sinopse+"</p>";
                    html += "<a class='link-anime' href='../"+item.diretorio+"'> Assista agora!</a>";
                    html += "</div>";
                    html += "</div>";
                    html += "</div>";
                });
                contentBox.innerHTML = html;
            })
            .catch(function (error){
                console.warn(error);
            });

    }
}