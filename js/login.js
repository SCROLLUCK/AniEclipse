var loginElement = document.querySelector('#botaoLogin');
var cadastroElement = document.querySelector('#botaoCadastro');

var contentInputs = document.querySelector('#contentInputs');

var nomeInputElement = document.querySelector('input[name=nome]');
var emailInputElement = document.querySelector('input[name=email]');
var confirmaSenhaInputElement = document.querySelector('input[name=confirmaSenha]');

var headLog = document.querySelector('#log');
var headCad = document.querySelector('#cad');

function trocaPraLogin(){

    $('input[name=nome]').removeClass('active_inp');
    $('input[name=nome]').removeClass('d_block');
    $('input[name=email]').removeClass('active_inp');
    $('input[name=email]').removeClass('d_block');
    $('input[name=confirmaSenha]').removeClass('active_inp');
    $('input[name=confirmaSenha]').removeClass('d_block');

    $('input[name=op]').attr('value', 'login');

    $('input[type=submit]').attr('value', 'ENTRAR');

    headLog.className = "active";
    headCad.className = "";
}

function trocaPraCadastro(){
    $('input[name=nome]').addClass('active_inp');
    $('input[name=nome]').addClass('d_block');
    $('input[name=email]').addClass('active_inp');
    $('input[name=email]').addClass('d_block');
    $('input[name=confirmaSenha]').addClass('active_inp');
    $('input[name=confirmaSenha]').addClass('d_block');

    $('input[name=op]').attr('value', 'cadastro');

    $('input[type=submit]').attr('value', 'CADASTRAR');

    headLog.className = "";
    headCad.className = "active";
}

loginElement.onclick = trocaPraLogin;

cadastroElement.onclick = trocaPraCadastro;

