<?php session_start(); ?>
<!DOCTYPE html>
<html>
    
    <?php 
      $titlePagina = "Login - Ani Eclipse";
      include("includes/head.php");
    ?>
    <link rel="stylesheet" href="css/login.css">
    <?php include("includes/menu.php");?>
    <body style="background-image: url(img/loginBack.jpg); background-size:cover">
        <div class="cont_principal">

  <div class="cont_centrar" style="-webkit-box-sizing: initial;">
  <div class="cont_login" id="contentLogin">
    <form action="controllers/auth.php" method="post">
    <div class="cont_tabs_login">
      <ul class='ul_tabs'>
        <li id="log" class="active"><a id="botaoLogin" style="cursor: pointer;">LOGIN</a>
        <span class="linea_bajo_nom"></span>
        </li>
        <li id="cad"><a id="botaoCadastro" style="cursor: pointer;">CADASTRE-SE</a><span class="linea_bajo_nom"></span>
        </li>
      </ul>
      </div>
  <div class="cont_text_inputs" id="contentInputs">
      <input type="text" class="input_form_sign " placeholder="NOME" name="nome" />
    
    <input type="text" class="input_form_sign" placeholder="EMAIL" name="email" />
    <input type="text" class="input_form_sign d_block active_inp" placeholder="NICKNAME" name="nickname">
    
    <input type="password" class="input_form_sign d_block  active_inp" placeholder="SENHA" name="senha" />  
   <input type="password" class="input_form_sign" placeholder="CONFIRME SUA SENHA" name="confirmaSenha" />
    <input type="hidden" name="op" id="op" value="login">
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
  
  <div class="cont_login" id="contentCadastro">
  </div>

</div>

    <script src="js/login.js"></script>
    </body>
    
</html>