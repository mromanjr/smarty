/*
* ------------------------------------------------------------------------------
*   IndiqueAmigo
* 	Utilizado na Página /produtos/item/index.php
* 	Rodolfo 16/02/2012
* ------------------------------------------------------------------------------
*/

var oIndiqueAmigo = {
    
    setObserve: function(){
        
        $("#cancelar-amigo").click(function(){
            oIndiqueAmigo.cancelarIndiqueAmigo();
        });
        
        $("#enviar-amigo").click(function(){
            oIndiqueAmigo.enviarIndiqueAmigo();
        });
        
    },
    
    enviarIndiqueAmigo: function(){
        
        $.ajax({
            url: _globalEnderecoNormal+'ajax/enviar_indiqueamigo.php',
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
                
                if(strData == 1){
                    
                    $('#error-forma').css('display','none');
                    $('input').css('background-color', '#fff'); 
                    $('textarea').css('background-color', '#fff'); 
                    alert('Sua indicação foi enviada com sucesso! \nQue tal indicar este produto para mais amigos?');
                    $('#f_nome_destinatario').val(''); $('#f_email_destinatario').val('');  $('#f_mensagem').val('');
                }
                
                if(strData == 0){
                    
                    $('#error-forma').css('display','none');
                    $('input').css('background-color', '#fff'); 
                    $('textarea').css('background-color', '#fff'); 
                    alert('Erro ao enviar e-mail! \nVerifique se os dados estão inseridos corretamente! ');
                }
                
                if(strData != 1 && strData != 0){
                
                    strData = unescape(strData);
                    var aData = strData.split(';');
                    for (var i in aData){
                        if(aData[i] != ""){
                            $("#"+aData[i]).css('background-color', '#f5f5f5');
                        }
                    }
                    $('#error-forma').css('display','block');
                    $('#error-forma').animate({height:'40px'}, 500);
                }
            }
        });
        return false;
    },

    showIndiqueAmigo: function() {

        var tamanhoBody = $(document).height() ;
        $('.overlay').css("height", tamanhoBody);
        $('.overlay').css("display", "block");
        $('#indique_amigo').css("display", "block");
    },
    
    cancelarIndiqueAmigo: function(){
        
        $('.overlay').css("display", "none");
        $('#indique_amigo').css("display", "none"); 
    }

};