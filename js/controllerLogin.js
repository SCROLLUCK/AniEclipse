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

function toggle_login(){
    var inputs = document.getElementsByClassName("input_form_sign");
    var botao = document.getElementsByClassName("btn_sign");
    var forgotPass = document.getElementsByClassName("link_forgot_pass");

    var log = document.getElementById("log");
    var cad = document.getElementById("cad");

    var funcao = document.getElementById("funcao");
    var termos = document.getElementById("termos");

    inputs[0].classList.toggle("d_block");
    inputs[0].classList.toggle("active_inp");
    inputs[1].classList.toggle("d_block");
    inputs[1].classList.toggle("active_inp");
    inputs[4].classList.toggle("d_block");
    inputs[4].classList.toggle("active_inp");
    forgotPass[0].classList.toggle("d_block");

    log.classList.toggle("active");
    cad.classList.toggle("active");

    if(botao[0].value == "ENTRAR"){
        botao[0].value = "CADASTRAR";
        termos.style.display = "none";
        funcao.value = "cadastrar";
    }else {
        botao[0].value = "ENTRAR";
        termos.style.display = "block";
        funcao.value = "logar";
    }

}

