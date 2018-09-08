<!DOCTYPE html>
<html>
    <head>
    <title>Entre ou cadastre-se - Ani Eclipse</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <link rel="stylesheet" type="text/css" href="css/menu-mobile.css" media="(max-width: 480px)">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="js/controllerLogin.js"></script>
    </head>
    <?php include("menu.php");?>
    <body style="background-image: url(img/up-files-2.jpg); background-size:cover">
        <div class="cont_principal">

  <div class="cont_centrar">
  <div class="cont_login">
    <form action="php/usuario.php" method="post">
    <div class="cont_tabs_login">
      <ul class='ul_tabs'>
        <li id="log" class="active"><a style="cursor: pointer;" onclick="toggle_login();">LOGIN</a>
        <span class="linea_bajo_nom"></span>
        </li>
        <li id="cad"><a style="cursor: pointer;" onclick="toggle_login();">CADASTRE-SE</a><span class="linea_bajo_nom"></span>
        </li>
      </ul>
      </div>
  <div class="cont_text_inputs">
      <input type="text" class="input_form_sign " placeholder="NOME" name="nome" />
    
    <input type="text" class="input_form_sign" placeholder="EMAIL" name="email" />
    <input type="text" class="input_form_sign d_block active_inp" placeholder="NICKNAME" name="nickname">
    
    <input type="password" class="input_form_sign d_block  active_inp" placeholder="SENHA" name="senha" />  
   <input type="password" class="input_form_sign" placeholder="CONFIRME SUA SENHA" name="confirmaSenha" />
    
    <a href="#" class="link_forgot_pass d_block" >Esqueci minha senha =/</a>    
<div class="terms_and_cons d_none">
    <p id="termos"><input type="checkbox" name="termos" /> <label for="terms_and_cons">Aceito os termos Uso e Privacidade</label></p>
  
    </div>
      </div>
<div class="cont_btn">
     <input type="submit" class="btn_sign" value="ENTRAR">
      <input type="hidden" id="funcao" name="funcao" value="logar">
      </div>
      
    </form>
    </div>
    
  </div>
  

</div>
    </body>
    
</html>