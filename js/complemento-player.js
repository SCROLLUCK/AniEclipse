var player, intervalTimer, drag;

/* CONTROLS */

var videoElement, playButton, fullscreen, timer, videoLoaded, videoProgress, barProgress, videoPreloader, slider, audioButton, icoAudio;
var LUCK = 80;

var epVideo = document.querySelector('video');
var loading = document.querySelector('#loading');

epVideo.onwaiting = function(){
    loading.style.display = "block";
};

epVideo.onplaying = function(){
    loading.style.display = "none";
};

function selectPlayer(elem){
    // VERIFICA O PLAYER EM FOCO
    if( player != elem ){ 
        player = elem;
    }

    // INSTANCIANDO OBJETOS
    videoElement   = player.querySelector('video'); // OBJETO VIDEO DO PLAYER
    timer          = player.querySelector('.time'); // TEMPO E ANDAMENTO DO VIDEO
    fullscreen     = player.querySelector('.fullscreen'); // BOTÃO FULLSCREEN


    // AÇÕES DE MOUSE
    fullscreen.addEventListener('click', expandPlayer);
    
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

        fullscreen.querySelector('i').className = "fa fa-compress";

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

        fullscreen.querySelector('i').className = "fa fa-expand";
    }

}

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
    videoElement.play();
  }
}