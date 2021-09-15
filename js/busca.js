$(document).ready(function(){  
    // aqui a função ajax que busca os dados em outra pagina do tipo html, não é json
    function load_dados(valores, page, div){
	        $.ajax({
	            type: 'POST',
                dataType: 'html',
                url: page,
                beforeSend: function(){
                    $(div).html("<div class='lds-css ng-scope'><div style='position: relative; float: left; left: 50%; transform: translateX(-50%); width: 80px; height: 80px;' class='lds-eclipse'><div style='width: 60px; height: 60px; transform-origin: 30px 34px;'></div></div></div>");
                },
                data: valores,
                success: function(msg){
                    var data = msg;
                    $(div).html(data).fadeIn();				
                }
	        });
    }
    
    //Aqui uso o evento key up para começar a pesquisar, se valor for maior q 0 ele faz a pesquisa
    $('#pesquisaCliente').keyup(function(){
        
        var valores = $('#form_pesquisa').serialize()//o serialize retorna uma string pronta para ser enviada
        
        //pegando o valor do campo #pesquisaCliente
        var $parametro = $(this).val();

        if($parametro.length >= 3){
            $('div#MostraPesq').show();
            load_dados(valores, '../../controllers/busca.php', '#MostraPesq');
        }
    });
});

$("body").click(function(){
    $('div#MostraPesq').hide();
});