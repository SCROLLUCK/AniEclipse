function readMouseMove(e){
  var player = document.getElementById("VIDEO");
  var nome = document.getElementById("NOMEA");
  var controls = document.getElementById('controls');
  player.style = "cursor:initial;";
  controls.style.opacity = "1";
  nome.style = "opacity:1;";

}
document.onmousemove = readMouseMove;

$( document ).ready(function() {
      });

function start(){
    var timeout = setTimeout(showTela, 3000);
    $(conteiner).mousemove(onEvent);
    $(conteiner).mousedown(onEvent);
    $(conteiner).keydown(onEvent);


    function onEvent() {
      clearTimeout(timeout);
          timeout = setTimeout(showTela, 3000);
      }

      function showTela() {
          var player = document.getElementById("VIDEO");
          var nome = document.getElementById("NOMEA");
          var controls = document.getElementById('controls');
          player.style = "cursor:none !important;";
          controls.style.opacity = "0";
          nome.style = "opacity:0;";

      }
    }

function SCREEM(){
    var body = document.getElementsByClassName("body");
    var CENTER = document.getElementsByClassName("CENTER");
    var conteiner = document.getElementsByClassName("conteiner");
    var largura = parseInt(body[0].clientWidth);
    
    if(largura < 1000){
        conteiner[0].style.width = "100%";
    }else {
        var larguraC = CENTER[0].clientWidth;
        var width = parseInt(larguraC - 400);
        conteiner[0].style.width = String(width) + 'px';
      }
}
function loop(){
  SCREEM();
  setTimeout(loop, 200);  
}