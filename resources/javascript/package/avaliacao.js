/*
* ------------------------------------------------------------------------------
*   Avaliacao
* 	Utilizado na Página /produtos/item/index.php
* 	Rodolfo 16/02/2012
* ------------------------------------------------------------------------------
*/

var oAvaliacao = {
    
    bClickAvaliacao: false,
    sEnderecoEstrela:       'url(' + _globalEnderecoImages + 'icones/estrela.png) no-repeat',
    sEnderecoEstrelaHover:  'url(' + _globalEnderecoImages + 'icones/estrela-hover.png) no-repeat',

    setObserve: function(){
        
        $("#botao-avaliacao").click(function(){
            oAvaliacao.showAvaliacao();
        }),
        
        $("#cancelar-avaliacao").click(function(){
            oAvaliacao.cancelarAvaliacao();
        }),
        
        $("#enviar-avaliacao").click(function(){
            oAvaliacao.enviarAvaliacao($('#classificacao').val());
        }),
        
        $('#est-1').mouseover(function(){
            
            if (oAvaliacao.bClickAvaliacao){
                return false;
            }
            
            for(var j=1; j<=1; j++){
                $('#est-'+j).css("background", oAvaliacao.sEnderecoEstrela);
                $('#classificacao').html("Ruim, fraco");
            }
        });

        $('#est-1').mouseout(function(){
            
            if (oAvaliacao.bClickAvaliacao){
                return false;
            }

            for(var j=1; j<=1; j++){
                $('#est-'+j).css("background", oAvaliacao.sEnderecoEstrelaHover);
                $('#classificacao').html("Clique para avaliar o produto");
            }
        });

        $('#est-2').mouseover(function(){
            
            if (oAvaliacao.bClickAvaliacao){
                return false;
            }

            for(var j=1; j<=2; j++){
                $('#est-'+j).css("background", oAvaliacao.sEnderecoEstrela);
                $('#classificacao').html("Podia ser Melhor");
            }
        });

        $('#est-2').mouseout(function(){
            
            if (oAvaliacao.bClickAvaliacao){
                return false;
            }

            for(var j=1; j<=2; j++){
                $('#est-'+j).css("background", oAvaliacao.sEnderecoEstrelaHover);
                $('#classificacao').html("Clique para avaliar o produto");
            }
        });

        $('#est-3').mouseover(function(){
            
            if (oAvaliacao.bClickAvaliacao){
                return false;
            }

            for(var j=1; j<=3; j++){
                $('#est-'+j).css("background", oAvaliacao.sEnderecoEstrela);
                $('#classificacao').html("Regular");

            }
        });

        $('#est-3').mouseout(function(){
            
            if (oAvaliacao.bClickAvaliacao){
                return false;
            }

            for(var j=1; j<=3; j++){
                $('#est-'+j).css("background", oAvaliacao.sEnderecoEstrelaHover);
                $('#classificacao').html("Clique para avaliar o produto");
            }
        });

        $('#est-4').mouseover(function(){
            
            if (oAvaliacao.bClickAvaliacao){
                return false;
            }

            for(var j=1; j<=4; j++){
                $('#est-'+j).css("background", oAvaliacao.sEnderecoEstrela);
                $('#classificacao').html("Muito bom!");
            }
        });

        $('#est-4').mouseout(function(){
            
            if (oAvaliacao.bClickAvaliacao){
                return false;
            }

            for(var j=1; j<=4; j++){
                $('#est-'+j).css("background", oAvaliacao.sEnderecoEstrelaHover);
                $('#classificacao').html("Clique para avaliar o produto");
            }
        });

        $('#est-5').mouseover(function(){
            
            if (oAvaliacao.bClickAvaliacao){
                return false;
            }

            for(var j=1; j<=5; j++){
                $('#est-'+j).css("background", oAvaliacao.sEnderecoEstrela);
                $('#classificacao').html("Excelente!");
            }
        });

        $('#est-5').mouseout(function(){
            
            if (oAvaliacao.bClickAvaliacao){
                return false;
            }

            for(var j=1; j<=5; j++){
                $('#est-'+j).css("background", oAvaliacao.sEnderecoEstrelaHover);
                $('#classificacao').html("Clique para avaliar o produto");
            }
        });
    },
	
	
    showAvaliacao: function(){
        
        var tamanhoBody = $(document).height() ;
        $('.overlay').css("height", tamanhoBody);
        $('.overlay').css("display", "block");
        $('#avaliacoes').css("display", "block");
        $(window).scrollTo($('#depto_topo'), 800);
    },

    cancelarAvaliacao: function(tipo){

        $('.overlay').css("display", "none");
        $('#avaliacoes').css("display", "none");
    },

    setSessionAvaliacao: function(codtamcor){
        
        $.ajax({
            url: _globalEnderecoNormal + 'ajax/setSessionAvaliacao.php',
            type: "get",
            dataType: "html",
            data: '_codtamcor='+codtamcor,
            success: function(){
                document.location.href= _globalEnderecoNormal + 'login/';
            }
        });
    },

    setAvaliacao: function(pos){

        if (this.bClickAvaliacao){
            return false;
        }

        $('#limpar-avaliacao').css("display","block");

        for(var j=1; j<=pos; j++){
            $('#est-'+j).css("background", this.sEnderecoEstrela);
            $('#est-'+j).stop();
            $('#classificacao').val(pos);
        }

        this.bClickAvaliacao = !this.bClickAvaliacao;
    },

    enviarAvaliacao: function(pos){

        if(pos == ""){
            $('#msgErro').css("display", "block");
            return false;
        }

        $.ajax({
            url: _globalEnderecoNormal + 'ajax/cadastrar_avaliacao.php',
            type: "get",
            dataType: "html",
            data: $('#frm_avaliacao').serialize()+'&indice='+pos,
            success: function(strData){
                $('.overlay').css("display", "none");
                $('#avaliacoes').css("display", "none");
                alert("Avaliação enviada com sucesso!");
                var url = window.location.href;
                aUrl = url.split("avaliacao");
                document.location.href=aUrl[0];
            }
        });
    },

    limpar_star: function(){
        
        this.bClickAvaliacao = false;
        
        for(var j=1; j<=5; j++){
            $('#est-'+j).css("background", this.sEnderecoEstrelaHover);
            $('#classificacao').html("Clique para avaliar o produto");
        }
        $('#limpar-avaliacao').css("display","none");
    },
	
	setSessionEmail: function(){
		
		$.ajax({
            url: _globalEnderecoNormal + 'ajax/setSessionAvaliacao.php',
            type: "get",
			data: "_email=1",
            dataType: "html",
            success: function(){
				oAvaliacao.showAvaliacao();
            }
        });
	}
	
};