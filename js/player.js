var player, intervalTimer, drag;

/* CONTROLS */

var videoElement, playButton, fullscreen, timer, videoLoaded, videoProgress, barProgress, videoPreloader, slider, audioButton, icoAudio;
var LUCK = 80;

function selectPlayer(elem){
    // VERIFICA O PLAYER EM FOCO
    if( player != elem ){ 
        player = elem;
    }

    // INSTANCIANDO OBJETOS
    videoElement   = player.querySelector('video'); // OBJETO VIDEO DO PLAYER
    timer          = player.querySelector('.time'); // TEMPO E ANDAMENTO DO VIDEO
    fullscreen     = player.querySelector('.full'); // BOTÃO FULLSCREEN
    playButton     = player.querySelector('.play'); // BOTÃO PLAY E PAUSE
    barProgress    = player.querySelector('.progress-bar'); // BARRA DE CONTROLE SEEK
    videoLoaded    = barProgress.querySelector('.video-loaded'); // BARRA DE CARREGAMENTO
    videoProgress  = barProgress.querySelector('.video-progress'); // PROGRESSO DO VÍDEO
    videoPreloader = player.querySelector('.loader'); // PROGRESSO DO VÍDEO
    slider         = player.querySelector('.slider'); 
    sliderVol      = slider.querySelector('.bar');
    audioButton    = player.querySelector('.audio');


    // AÇÕES DE MOUSE
    playButton.addEventListener('click', playVideo);
    fullscreen.addEventListener('click', expandPlayer);
    barProgress.addEventListener('click', seeker);
    slider.addEventListener('mousedown', startDrag);
    slider.addEventListener('mousemove', showVolume);
    sliderVol.addEventListener('mousemove', showVolume);
    slider.addEventListener('mouseup', startDrag);
    sliderVol.addEventListener('mouseup', startDrag);
    sliderVol.querySelector('span').addEventListener('mouseup', startDrag);
    document.addEventListener('mouseup', startDrag);


    audioButton.addEventListener('click', mute);

    videoElement.addEventListener('ended', resetVideo);
    videoElement.addEventListener('waiting', loaderVideo);
    videoElement.addEventListener('playing', loaderVideo);

    document.addEventListener('keydown', pegaTecla);
    document.addEventListener('onkeydown', exitFULL);
    
    updateTimer();
}


function startDrag(event){

    if(event.type == "mousedown"){

        drag = true;
    }else{

        drag = false;
    }
}


function showVolume(event){
    if(drag){
        var w = slider.clientWidth;
        var x = (event.clientX) - slider.offsetLeft;

        var pctVol = x/w;

        if(pctVol >1 ){
            sliderVol.style.width = 100+"%";
            videoElement.volume = 1;

        }else if( pctVol < 0 ){
            sliderVol.style.width = 0+"%";
            videoElement.volume = 0;

        }else{
            sliderVol.style.width = (x/w) * 100+"%";
            videoElement.volume = pctVol;
        }


        if(pctVol<=0){
            audioButton.querySelector('i').className = 'fas fa-volume-mute';
        }else if(pctVol>0 && pctVol<=0.6){
            audioButton.querySelector('i').className = 'fas fa-volume-down';
        }else{
            audioButton.querySelector('i').className = 'fas fa-volume-up';
        }
    }
}


function seeker(event){
    var C = document.getElementsByClassName("CENTER");
    var B = document.getElementsByClassName("body");
    if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {
        LUCK = (B[0].clientWidth - C[0].clientWidth) /2 ; //subitrai o CENTER do Body e divide por 2 pra obiter o width em PX do lado esquerdo.
        LUCK = LUCK + 10; //soma o pedaço esquerdo do center com o padding erquerdo da progress-bar.
    }else {
        LUCK = 10;
    }
    pctBar = ((event.clientX - LUCK)  / barProgress.clientWidth) *100;
    videoElement.currentTime = (videoElement.duration * pctBar) /100;
}

function loaderVideo(event){

    if(event.type == 'waiting'){
        videoPreloader.style.display = "block";
    }else{
        videoPreloader.style.display = "none";
    }

}


function mute(){

    if(!videoElement.muted){
        videoElement.muted = true;
        videoElement.volume = 0;
        sliderVol.style.width = 0+"%";
        audioButton.querySelector('i').className = 'fas fa-volume-mute';

    }else{
        videoElement.muted = false;
        audioButton.querySelector('i').className = 'fas fa-volume-up';
        videoElement.volume = 0.9;
        sliderVol.style.width = 90+"%";

    }
}

function updateTimer(event){

    bufferedEnd = videoElement.buffered.end(videoElement.buffered.length - 1);

    videoLoaded.style.width = String((bufferedEnd / videoElement.duration) * 100)+'%';


    pctSeek = (videoElement.currentTime / videoElement.duration) * 100;

    videoProgress.style.width = String(pctSeek)+'%';


    //Duração total do video
    hour = Math.floor(videoElement.duration / 3600);
    min = Math.floor(videoElement.duration / 60);
    seg = Math.floor(((videoElement.duration / 60) % 1) * 60);

    //CurrentTime
    currentHour = Math.floor(videoElement.currentTime / 3600);
    currentMin = Math.floor(videoElement.currentTime / 60);
    currentSeg = Math.floor(((videoElement.currentTime / 60) % 1) * 60);

    timer.querySelector('.time-video').innerHTML = convertTimer(currentHour, currentMin, currentSeg) + ' / ' + convertTimer(hour, min, seg);
}
function resetVideo(){

    playButton.querySelector('i').className = "fas fa-play"; // MUDA O ICONE DO BOTÃO PAUSE PARA PAUSE
    videoElement.currentTime = 0;
    clearInterval(intervalTimer);
}

function ProxEP(){
    if(videoElement.played.length == videoElement.currentTime){
        alert("Proximo Episodio");
    }
}

function playVideo(){

    var PAUSADO = document.getElementById('PAUSADO');
    // VERIFICA SE O VIDEO FOI INICIADO 
    if(videoElement.played.length != 0){

        // VERIFICA SE O VIDEO FOI INICIADO E ESTÁ PAUSADO
        if(videoElement.played.start(0)==0 && !videoElement.paused){

            PAUSADO.style.display = "block";

            clearInterval(intervalTimer);

            videoElement.pause(); // PAUSA O VÍDEO

            playButton.querySelector('i').className = "fas fa-play"; // MUDA O ICONE DO BOTÃO PAUSE PARA PAUSE

        }else{
            PAUSADO.style.display = "none";
            intervalTimer = setInterval(updateTimer, 100); // ATUALIZA O METODO UPDATE TIMER
            videoElement.play();
            playButton.querySelector('i').className = "fas fa-pause"; // MUDA O ICONE DO BOTÃO PLAY PARA PAUSE

        }

    }else{
        intervalTimer = setInterval(updateTimer, 100); // ATUALIZA O METODO UPDATE TIMER
        videoElement.play(); // INICIA O VÍDEO
        playButton.querySelector('i').className = "fas fa-pause"; // MUDA O ICONE DO BOTÃO PLAY PARA PAUSE
    }

}




//METODO QUE CONVERTE A DURAÇÃO DO VIDEO EM HH:MM:SS 
function convertTimer(horas, minutos, segundos){

    if(horas<10 && horas>0){
        horas = '0' + String(horas) +":";
    }else{ horas = ''; }

    if(minutos<10){
        minutos = '0' + String(minutos);
    }else if(minutos > 59){
        minutos = minutos - (Math.floor(minutos / 60) * 60);
    }

    if(segundos<10){
        segundos = '0' + String(segundos);
    }

    return String(horas) + String(minutos) + ':' + String(segundos);
}



/**
 * FAZ E DESFAZ A AÇÃO DE EXPANDIR EM TELA CHEIA FULLSCREEN
 */
function expandPlayer(){

    if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {
        if (player.requestFullscreen) {
            player.requestFullscreen();
        } else if (player.msRequestFullscreen) {
            player.msRequestFullscreen();
        } else if (player.mozRequestFullScreen) {
            player.mozRequestFullScreen();
        } else if (player.webkitRequestFullscreen) {
            player.webkitRequestFullscreen();
        }

        fullscreen.querySelector('i').className = "fas fa-compress-arrows-alt";

    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        }

        fullscreen.querySelector('i').className = "fas fa-expand-arrows-alt";
    }

}
function exitFULL(event){
    if (event.keyCode == 27) {event.preventDefault();}
    expandPlayer(); 
}

function pegaTecla(event){
  var tecla = event.keyCode;
  
  if(tecla == 77){
    mute();
 }
  if(tecla == 121){ //F10 - Full SCREEN
    expandPlayer();
  }
  if(tecla == 103){
    videoElement.currentTime = 0;
  }
  if(tecla == 32){ //ESPAÇO - play/pause
    playVideo();
  }
}