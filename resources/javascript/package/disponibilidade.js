/*
* ------------------------------------------------------------------------------
*   IndiqueAmigo
* 	Utilizado na Página /produtos/item/index.php
* 	Rodolfo 16/02/2012
* ------------------------------------------------------------------------------
*/

var oDisponibilidade = {
    
    setObserve: function(){
        
        $("#cancelar-disponibilidade").click(function(){
            oDisponibilidade.cancelarDisponibilidade();
        });
        
        $("#enviar-disponibilidade").click(function(){
            oDisponibilidade.enviarDisponibilidade();
        });
        
    },
    
    enviarDisponibilidade: function(){
        
        $.ajax({
            url: _globalEnderecoNormal+'ajax/avisar_disponibilidade.php',
            type: "post",
            dataType: "html",
            data: $('form').serialize(),
            beforeSend: function(){
                var pageHeight = $('body').height();
                $('.overlay').css("height",pageHeight);
                $('.overlay').css("display","block");
                $('#loading').html('<img src="'+_globalEnderecoImages+'/icones/loading.gif"/>');
            },
            success: function(strData){
                
                eval(unescape(strData));
            }
        });
        return false;
    },

    showDisponibilidade: function() {

        var tamanhoBody = $(document).height() ;
        $('.overlay').css("height", tamanhoBody);
        $('.overlay').css("display", "block");
        $('#avise-disponibilidade').css("display", "block");
    },
    
    cancelarDisponibilidade: function(){
        
        $('.overlay').css("display", "none");
        $('#avise-disponibilidade').css("display", "none"); 
    }

};