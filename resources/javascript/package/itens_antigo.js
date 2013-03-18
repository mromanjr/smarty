/**
* -------------------------------------------------------------------------------
* Itens
* Utilizado na página /produtos/item/index.php
* -------------------------------------------------------------------------------
*/
var oItens = {
	
    setPrincipal: function(codfotoNew) {
        var codfotoOld = $('#codfotoprincipal').val();
        $('.foto-principal-'+codfotoOld).hide();
        $('.foto-principal-'+codfotoNew).show();
        
        $('.foto').css("border","1px solid #f5f5f5");
        $('#foto-produto-'+codfotoNew).css("border","1px solid #8B4774");
        
        var options = {
            zoomType: 'reverse',
            lens:true,
            preloadImages: true,
            alwaysOn:false,
            zoomWidth: 430,
            zoomHeight: 380,
            xOffset:10,
            yOffset:0,
            position:'right',
            preloadText: false,
            title: false
        };
        $('.foto-principal-'+codfotoNew).jqzoom(options);
        $('#codfotoprincipal').val(codfotoNew);
    },

    changeItem: function(codtamcor, tipo, codfoto) {
                
        if(tipo == 'T'){

            $('#codtamcor').val(codtamcor)
            this.showItem(codtamcor, codfoto);
        }else{
            this.showItem(codtamcor, codfoto);
        }
    },

    addCart: function() {
        location.href=_globalEnderecoNormal+"carrinho/"+$('#codtamcor').val();
    },

    showItem: function(codtamcor, codfoto) {
        if(codtamcor!=""){
            //var sUrl = _globalEnderecoNormal+'produtos/item/index.php';
            var sUrl = _globalEnderecoNormal+'produtos/item/itens_informacoes.php?_cod='+codtamcor;
        }
        $.ajax({
            url: sUrl,
            type: "POST",
            dataType: "html",
            //data: 'xhr='+(new Date().getTime())+"&fn=carregaInfo&p="+codtamcor,
            success: function( strData ){
                strData = unescape(strData)
                var aStr = strData.split('|');
                var sHtml = aStr[0];
                var command = aStr[1];
                $('#itens-informacoes').html(sHtml);
                eval(command);
            },
            complete: function(){

                if (codfoto > 0){
                    oItens.setPrincipal(codfoto);
                }

                $('#foto-principal a').lightBox({
                    imageLoading: _globalEnderecoJS + 'lib/lightbox/images/lightbox-ico-loading.gif',
                    imageBtnClose: _globalEnderecoImages + 'botoes/bt_fechar.png',
                    imageBtnPrev: _globalEnderecoImages + 'botoes/bt_anterior.png',
                    imageBtnNext: _globalEnderecoImages + 'botoes/bt_proximo.png',
                    imageBlank: _globalEnderecoImages + 'botoes/lightbox-blank.gif',
                    containerResizeSpeed: 600,
                    txtImage: 'Imagem',
                    txtOf: 'de'
                });

                var options = {
                    zoomType: 'reverse',
                    lens:true,
                    preloadImages: true,
                    alwaysOn:false,
                    zoomWidth: 430,
                    zoomHeight: 380,
                    xOffset:10,
                    yOffset:0,
                    position:'right',
                    preloadText: false,
                    title: false
                };
                $('.foto-principal-'+$('#codfotoprincipal').val()).jqzoom(options);
            }
        });
        return false;
    }

};