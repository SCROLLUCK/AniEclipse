function LimpaBuffer(){
    var menu = document.getElementById("menu");
    var ICO = document.getElementById("ICO-menu");
    if($(window).width() < 701){
        ICO.setAttribute("data-menu",0);
        menu.style.display = "none";
    }
}
function menu(icone){
    var menu = document.getElementById("menu");
    
    if(icone.getAttribute("data-menu") == 0){
        menu.style.display = "block";
        icone.setAttribute("data-menu",1);
    }else{
        LimpaBuffer();
    }
}