//EXIBIÇÃO DIFERENCIADA DO CONTENT EPISODIOS
    
    function exibe(conteudo){
        var contentBox = document.querySelector("#box");
        var html = "<ul id='TEMPORADA-ATUAL' class='TT'>";
        if(conteudo == 'recentes'){
            contentBox.innerHTML = "<div class='lds-css ng-scope'><div style='position: relative; float: left; left: 50%; transform: translateX(-50%);' class='lds-eclipse'><div></div></div></div>";
           
            axios.get('http://localhost:8080/controllers/episodios.php?recentes')
                .then(function(response){
                    contentBox.innerHTML = "";
                    response.data.forEach((item) => {
                        html += "<div class='EP LANCA'>";
                        html += "<p class='tempo'>"+item.duracao+"</p>";
                        item.final ? html += "<p class='final'>FINAL</p>" : html += "";
                        html += "<a class='LINK-EP' href='http://localhost:8080/"+item.obra.diretorio+"/episodio.php?ep="+item.numero+"' title='"+item.nome+"'></a>";
                        html += "<img class='THUMB' src='http://localhost:8080/"+item.obra.diretorio+"/img/"+item.thumb+"'>";
                        html += "<div class='identifica'>";
                        html += "<a class='link-logo' href='http://localhost:8080/"+item.obra.diretorio+"' title='"+item.obra.nome+"'>";
                        html += "<img class='logo-anime' src='http://localhost:8080/"+item.obra.diretorio+"/img/logo.png'>";
                        html += "</a>";
                        html += "<a href='http://localhost:8080/"+item.obra.diretorio+"/episodio.php?ep="+item.numero+"'>";
                        html += "<p class='episodio'>EPISODIO "+item.numero+" <span class='dataPostagem' data-postagem='"+item.dataPostagem+"'> - "+getTempoPostagem(item.dataPostagem)+"</span></p>";
                        html += "<p class='anime'>"+item.obra.nome.toUpperCase()+"</p>";
                        html += "<p class='nomeEP'>"+item.nome+"</p>";
                        html += "</a>";
                        html += "</div>";
                        html += "</div>";
                    });
                    html += "</ul>";
                    contentBox.innerHTML = html;
                })
                .catch(function(error){
                    console.warn(error);
                });

        }else if(conteudo == 'animes'){
            contentBox.innerHTML = "<div class='lds-css ng-scope'><div style='position: relative; float: left; left: 50%; transform: translateX(-50%);' class='lds-eclipse'><div></div></div></div>";

            axios.get('http://localhost:8080/controllers/episodios.php?lancamentos')
                .then(function(response){
                    contentBox.innerHTML = "";
                    response.data.forEach((item) => {
                        html += "<div class='EP LANCA'>";
                        html += "<p class='tempo'>"+item.duracao+"</p>";
                        item.final ? html += "<p class='final'>FINAL</p>" : html += "";
                        html += "<a class='LINK-EP' href='http://localhost:8080/"+item.obra.diretorio+"/episodio.php?ep="+item.numero+"' title='"+item.nome+"'></a>";
                        html += "<img class='THUMB' src='http://localhost:8080/"+item.obra.diretorio+"/img/"+item.thumb+"'>";
                        html += "<div class='identifica'>";
                        html += "<a class='link-logo' href='http://localhost:8080/"+item.obra.diretorio+"' title='"+item.obra.nome+"'>";
                        html += "<img class='logo-anime' src='http://localhost:8080/"+item.obra.diretorio+"/img/logo.png'>";
                        html += "</a>";
                        html += "<a href='http://localhost:8080/"+item.obra.diretorio+"/episodio.php?ep="+item.numero+"'>";
                        html += "<p class='episodio'>EPISODIO "+item.numero+" <span class='dataPostagem' data-postagem='"+item.dataPostagem+"'> - "+getTempoPostagem(item.dataPostagem)+"</span></p>";
                        html += "<p class='anime'>"+item.obra.nome.toUpperCase()+"</p>";
                        html += "<p class='nomeEP'>"+item.nome+"</p>";
                        html += "</a>";
                        html += "</div>";
                        html += "</div>";
                    });
                    html += "</ul>";
                    contentBox.innerHTML = html;
                })
                .catch(function(error){
                    console.warn(error);
                });

        }
    }

    function exibirLista(tipo){
        var listaObras = document.querySelector('#LISTA');
        var html = "";
        if(tipo == 'lancamentos'){
            listaObras.innerHTML = "<div class='lds-css ng-scope'><div style='position: relative; float: left; left: 50%; transform: translateX(-50%);' class='lds-eclipse'><div></div></div></div>";
            
            axios.get('http://localhost:8080/controllers/animes.php?lancamentos').
                then(function(response){
                    listaObras.innerHTML = "";
                    response.data.forEach( (item, index) => {

                       html += "<div class='Capsula'>";
                       html += "<div class='Anime'>";
                       html += "<a href='http://localhost:8080/"+item.diretorio+"' class='linkcapa' title='"+item.nome+"'></a>"
                       html += "<div class='thumb-episodio' style='background: #1b1a1a url(http://localhost:8080/"+item.diretorio+"/img/"+item.capa+"); background-size: cover; background-position: center;'>";
                       html += "<p class='nome-anime'>"+item.nome+"<i class='fa fa-info-circle INFo' data-index='"+index+"' data-show='0' aria-hidden='true' onclick='mostraInfoAnime(this);'></i></p>";
                       html += "<div class='Info-anime'>";
                       html += "<p class='Sinopse'><span class='name-info'>Sinopse: </span>"+item.sinopse+"</p>";
                       html += "<a class='link-anime' href='http://localhost:8080/"+item.diretorio+"'>Assista Agora!</a>";
                       html += "</div>";
                       html += "</div>";
                       html += "</div>";
                       html += "</div>";

                    });
                    listaObras.innerHTML = html;
                })
                .catch(function(error){
                    console.warn(error);
                });

        }else if(tipo == 'recentes'){
            listaObras.innerHTML = "<div class='lds-css ng-scope'><div style='position: relative; float: left; left: 50%; transform: translateX(-50%);' class='lds-eclipse'><div></div></div></div>";
            
            axios.get('http://localhost:8080/controllers/animes.php?recentes').
                then(function(response){
                    listaObras.innerHTML = "";
                    response.data.forEach( (item, index) => {

                       html += "<div class='Capsula'>";
                       html += "<div class='Anime'>";
                       html += "<a href='http://localhost:8080/"+item.diretorio+"' class='linkcapa' title='"+item.nome+"'></a>"
                       html += "<div class='thumb-episodio' style='background: #1b1a1a url(http://localhost:8080/"+item.diretorio+"/img/"+item.capa+"); background-size: cover; background-position: center;'>";
                       html += "<p class='nome-anime'>"+item.nome+"<i class='fa fa-info-circle INFo' data-index='"+index+"' data-show='0' aria-hidden='true' onclick='mostraInfoAnime(this);'></i></p>";
                       html += "<div class='Info-anime'>";
                       html += "<p class='Sinopse'><span class='name-info'>Sinopse: </span>"+item.sinopse+"</p>";
                       html += "<a class='link-anime' href='http://localhost:8080/"+item.diretorio+"'>Assista Agora!</a>";
                       html += "</div>";
                       html += "</div>";
                       html += "</div>";
                       html += "</div>";

                    });
                    listaObras.innerHTML = html;
                })
                .catch(function(error){
                    console.warn(error);
                });

        }else if(tipo == 'animes'){
            listaObras.innerHTML = "<div class='lds-css ng-scope'><div style='position: relative; float: left; left: 50%; transform: translateX(-50%);' class='lds-eclipse'><div></div></div></div>";
            
            axios.get('http://localhost:8080/controllers/animes.php?todos')
                .then(function(response){
                    listaObras.innerHTML = "";
                    response.data.forEach((item, index) => {
                       html += "<div class='Capsula'>";
                       html += "<div class='Anime'>";
                       html += "<a href='http://localhost:8080/"+item.diretorio+"' class='linkcapa' title='"+item.nome+"'></a>"
                       html += "<div class='thumb-episodio' style='background: #1b1a1a url(http://localhost:8080/"+item.diretorio+"/img/"+item.capa+"); background-size: cover; background-position: center;'>";
                       html += "<p class='nome-anime'>"+item.nome+"<i class='fa fa-info-circle INFo' data-index='"+index+"' data-show='0' aria-hidden='true' onclick='mostraInfoAnime(this);'></i></p>";
                       html += "<div class='Info-anime'>";
                       html += "<p class='Sinopse'><span class='name-info'>Sinopse: </span>"+item.sinopse+"</p>";
                       html += "<a class='link-anime' href='http://localhost:8080/"+item.diretorio+"'>Assista Agora!</a>";
                       html += "</div>";
                       html += "</div>";
                       html += "</div>";
                       html += "</div>";
                    });
                    listaObras.innerHTML = html;
                })
                .catch(function(error){
                    console.warn(error);
                });
        }
        else{
            listaObras.innerHTML = "<div class='lds-css ng-scope'><div style='position: relative; float: left; left: 50%; transform: translateX(-50%);' class='lds-eclipse'><div></div></div></div>";
            
            axios.get('http://localhost:8080/controllers/animes.php?gen='+tipo)
                .then(function(response){
                    listaObras.innerHTML = "";
                    response.data.forEach((item, index) => {
                       html += "<div class='Capsula'>";
                       html += "<div class='Anime'>";
                       html += "<a href='http://localhost:8080/"+item.diretorio+"' class='linkcapa' title='"+item.nome+"'></a>"
                       html += "<div class='thumb-episodio' style='background: #1b1a1a url(http://localhost:8080/"+item.diretorio+"/img/"+item.capa+"); background-size: cover; background-position: center;'>";
                       html += "<p class='nome-anime'>"+item.nome+"<i class='fa fa-info-circle INFo' data-index='"+index+"' data-show='0' aria-hidden='true' onclick='mostraInfoAnime(this);'></i></p>";
                       html += "<div class='Info-anime'>";
                       html += "<p class='Sinopse'><span class='name-info'>Sinopse: </span>"+item.sinopse+"</p>";
                       html += "<a class='link-anime' href='http://localhost:8080/"+item.diretorio+"'>Assista Agora!</a>";
                       html += "</div>";
                       html += "</div>";
                       html += "</div>";
                       html += "</div>";
                    });
                    listaObras.innerHTML = html;
                })
                .catch(function(error){
                    console.warn(error);
                });
        }
    }