<?php /* Smarty version Smarty 3.1.4, created on 2013-03-19 12:41:42
         compiled from "application/views/templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1276514774144cfad5-96251620%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd304e7d7913bc61a5ba57117e97d53a86f77f79d' => 
    array (
      0 => 'application/views/templates/header.tpl',
      1 => 1363695233,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1276514774144cfad5-96251620',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_514774146f5a8',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_514774146f5a8')) {function content_514774146f5a8($_smarty_tpl) {?><?php echo doctype();?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta name="google-site-verification" content="pJJdEo6K8bKiryYfRJBZgtYwZ6y1_3mF1CetIWrBfCA" />
        <title>:.Webracks.:</title>
        <?php echo link_tag('resources/css/estilos.css');?>

        <?php echo link_tag('resources/css/listagem.css');?>

        <?php echo link_tag('resources/javascript/lib/coin-slider/coin-slider-styles.css');?>

        <?php echo link_tag('resources/javascript/lib/jq-ui/css/ui-lightness/jquery-ui-1.8.16.custom.css');?>
        
        <meta name="keywords" content="racks,bagageiros,bagageiro,bagageiro teto,suporte, bicicleta, bicicleta infantil,bicicletas,mountain bike, prancha surf, suporte caiaque,suporte equipamentos aquáticos, rack carro, monitores cardíacos, monitor cardiaco, relógio monitor cardíaco"/>
        <script type="text/javascript" charset="ISO-8859-1" src="<?php echo base_url();?>
resources/javascript/lib/jquery.js"></script>
        <script type="text/javascript" charset="ISO-8859-1" src="<?php echo base_url();?>
resources/javascript/lib/coin-slider/coin-slider.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>
resources/javascript/lib/jq-ui/js/jquery-ui-1.8.16.custom.min.js"></script>
        
            <script type="text/javascript">
              var _gaq = _gaq || [];
              _gaq.push(['_setAccount', 'UA-21736347-2']);
              _gaq.push(['_trackPageview']);
              _gaq.push(['_trackPageLoadTime']);
              (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
              })();
            </script>
        


        
            <style type="text/css">
                .ui-widget-header{
                   background-color: #1F5AB2;
                   background-image: none;
                }    
                .ui-slider .ui-slider-handle{
                    width: 1.0em;
                    height: 1.0em;
                }
            </style>
       
            <script type="text/javascript">
                    $(function() {
                            $( "#slider-range" ).slider({
                                    range: true,
                                    min: 0,
                                    max: 4999,
                                    values: [ 100, 2000 ],
                                    slide: function( event, ui ) {
                                            $( "#amount" ).val( "R$" + ui.values[ 0 ] + " - R$" + ui.values[ 1 ] );
                                    }
                            });
                            $( "#amount" ).val( "R$" + $( "#slider-range" ).slider( "values", 0 ) +
                                    " - R$" + $( "#slider-range" ).slider( "values", 1 ) );
                    });

                $('document').ready(function(){

                    $("#slider-range").bind("slidechange", function(event, ui){
                        location.href="http://www.webracks.com.br/preco/"+ui.values[0]+"-"+ui.values[1]+"/";
                    });

                });

            </script>

            <script type="text/javascript">
                $(document).ready(function() {
                    $('#coin-slider').coinslider({
                        width: 980,         // width of slider panel
                        height: 280,        // height of slider panel
                        spw: 10,            // squares per width
                        sph: 5,             // squares per height
                        delay: 5000,        // delay between images in ms
                        sDelay: 10,         // delay beetwen squares in ms
                        opacity: 0.7,       // opacity of title and navigation
                        titleSpeed: 500,    // speed of title appereance in ms
                        effect: '',         // random, swirl, rain, straight
                        navigation: true,   // prev next and buttons
                        links : true,       // show images as links
                        hoverPause: true    // pause on hover
                    });
                });
            </script>


            <script type="text/javascript" charset="ISO-8859-1">

                var _globalSiteNome		  =	'Webracks';
                var _globalEnderecoNormal = 'http://www.webracks.com.br/';
                var _globalEnderecoPHP	  = 'http://www.webracks.com.br/php/';
                var _globalEnderecoImages = 'http://www.webracks.com.br/resources/images/';
                var _globalEnderecoJS     = 'http://www.webracks.com.br/resources/javascript/';

                var _globalTextoPadraoPesquisa = 'Digite sua pesquisa aqui';

                /*var _globalMarcas = [];*/

                /* GOOGLE + */
                window.___gcfg = {lang: 'pt-BR'};

                  (function() {
                    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                    po.src = 'https://apis.google.com/js/plusone.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                  })();

            </script>
            <!-- FACEBOOK -->
            <div id="fb-root"></div>
            <script>
                (function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            </script>
        
    </head>
<body>
    
    <div id="container"> 
    <!--INÍCIO CONTAINER-->	
    <!--[if lte IE 7]>
        <div style='background-color:#FFFEE0;font-size:12px;text-align:center;margin-bottom:5px'>
        <b>Esta versão do navegador está desatualizada.</b><br />
        Para navegar neste site com maior segurança, recomendamos utilizar o
        <a target="_blank" style="color:blue" href="http://br.mozdev.org/firefox/download/">Mozilla Firefox</a> ou
        <a target="_blank" style="color:blue" href="https://www.google.com/chrome?hl=pt-br">Google Chrome</a>.
        <br /></div>
    <![endif]-->
    
    <script type="text/javascript" charset="ISO-8859-1" >
        $(document).ready(function(){
            $('#_q').focus(function(){
               if($('#_q').val() == 'Digite sua pesquisa aqui'){
                   $('#_q').val('');
                   $('#_q').css({'font-weight':'bold','color':'black'});
               }
            });                

            $('#q').blur(function(){
               if($('#_q').val() == ''){
                   $('#_q').val('Digite sua pesquisa aqui');
               }
            });

            $('#_q').click(function(){
                $('#_q').select();
                $('#_q').css({'font-weight':'bold','color':'black'});
            });

        });

        function resumoCarrinho(condicao){
            if(condicao){
                $('#resumoCarrinho').css({'display':'block'});
            }else{
                $('#resumoCarrinho').css({'display':'none'});
            }
        }

        function menuTipos(indice, condicao){
            if(condicao){
                //$('#menu-hover-'+indice).slideDown();
                $('#menu-hover-'+indice).show();
            }else{
                //$('#menu-hover-'+indice).slideUp();
                $('#menu-hover-'+indice).hide();
            }
        }
    </script>
    
    <!--INÍCIO TOPO-->
    <div id="header">
        <div id="topo">
            <div id="clientes">
                <ul>
                    <li><?php echo anchor((base_url()).('institucional/sobre-a-webracks'),'Empresa');?>
</li>
                    <li><?php echo anchor((base_url()).('contato'),'Contato');?>
</li>
                    <li><?php echo anchor((base_url()).('minhascompras'),'Meus Pedidos');?>
</li>
                    <li><?php echo anchor((base_url()).('clientes'),'Cadastro');?>
</li>
                </ul>
            </div>
            <div id="logo">
                <?php echo anchor(base_url(),img('resources/images/topo/logo.jpg'));?>
        
            </div>

            <div id="telefone">
                Vendas <b>(11) 4491-3051</b>
            </div>
            <div id="saudacao">
                Olá visitante! <?php echo anchor((base_url()).('clientes'),'Identifique-se aqui');?>

            </div>           
            
            <form id="pesquisa" name="frmSearch" method="get" action="http://www.webracks.com.br/produtos/pesquisa.php">
                <input style="font-weight:bold" type="text" name="_q" id="_q" size="10" maxlength="255" value="Digite sua pesquisa aqui" title="Pesquise..." />
                <input type="submit" style="display:none;"/>
                <a href="http://www.webracks.com.br/produtos/pesquisa.php" id="bt-pesquisa" class="bt-pesquisa" onclick="$('#pesquisa').submit();return false;"></a>
            </form>

            <div id="ofertas">
                <a style="width:79px;height:82px;" href="http://www.webracks.com.br/promocoes/">
                    <img src="http://www.webracks.com.br/resources/images/topo/ofertas.jpg"></img>
                </a>
            </div>        

            <div class="carrinho">
                <div class='carrinho-hover' onMouseOver="resumoCarrinho(1)" onMouseOut="resumoCarrinho(0)">
                    <a href="http://www.webracks.com.br/carrinho/" id="lnk-top-carrinho"></a>
                    <a id="carrinho" id="lnk-top-carrinho" href="http://www.webracks.com.br/carrinho/">Carrinho</a>
                    <font style="position: absolute;font-size:12px;margin-top:32px;color:#333;right:120px;">2 Itens</font>
                </div>
            </div>        
        </div><!--FIM TOPO-->
    </div><!--FIM header-->
    
        
    <!-- HOVER CARRINHO -->

    <div id="resumoCarrinho" onMouseOver="resumoCarrinho(1)" onMouseOut="resumoCarrinho(0)">
        <ul style='height:50px; font-size:12px; border-bottom: 1px solid #aaa; padding-top: 5px'>
            <li>
                <div style='float:left; margin-right:10px'>
                    <img src="http://www.webracks.com.br/php/classes/imagem/img6.php?_a=000567001.jpg" alt="" title=""/>
                </div>                
                <div style='color:#555; font-size:11px; position:absolute; padding:0 10px 0 70px'>Colchão Inflável Infanto Juvenil  - 6355 - Mor</div>
                <div style='float:right; margin:30px 5px 0 0; font-weight: bold; color:#777'>R$ 42,00</div>
            </li>
        </ul>
        <ul style='height:50px; font-size:12px; border-bottom: 1px solid #aaa; padding-top: 5px'>
            <li>
                <div style='float:left; margin-right:10px'> 
                    <img src="http://www.webracks.com.br/php/classes/imagem/img6.php?_a=000113007.jpg" alt="" title=""/> 
                </div>
                <div style='color:#555; font-size:11px; position:absolute; padding:0 10px 0 70px'>Rack Completo Jetbag - Teto Plano 107269 - Jetbag</div>
                <div style='float:right; margin:30px 5px 0 0; font-weight: bold; color:#777'>R$ 369,00</div>
            </li>
        </ul>
        
        <div class='sub-total' >Sub Total: R$ 411,00 </div>
        
        <div style='margin:10px 0 0 70px'>
            <a href='http://www.webracks.com.br/endereco/' >
                <img src=' http://www.webracks.com.br/resources/images/botoes/finalizar_compra.jpg' />
            </a>
        </div> 
    </div>
    
    <!-- HOVER CARRINHO FIM -->        
    
    <!-- Departamentos -->
    <div id="depto_topo">
        <ul>
            <li>
                <div class='menu-evento' onMouseOver='menuTipos(1,1);' onMouseOut='menuTipos(1,0);'>
                    <a href='http://www.webracks.com.br/racks-bagageiros/1/'>Racks & Bagageiros</a>
                </div>
                <div onMouseOver='menuTipos(1,1);' onMouseOut='menuTipos(1,0);' class='menu-hover' id='menu-hover-1'>
                    <img style='position:absolute; padding:6px 0 0 2px; width:auto;' src='http://www.webracks.com.br/resources/images/icones/bullet3.png'></img>
                    <a style='margin-left:15px' href='http://www.webracks.com.br/bagageiros-de-teto/1/6/'>Bagageiros de Teto </a>
                    <br/>
                    
                    <img style='position:absolute; padding:6px 0 0 2px; width:auto;' src='http://www.webracks.com.br/resources/images/icones/bullet3.png'></img>
                    <a style='margin-left:15px' href='http://www.webracks.com.br/suporte-para-bicicletas/1/1/'>Suporte Para Bicicletas </a>
                    <br/>
                    <img style='position:absolute; padding:6px 0 0 2px; width:auto;' src='http://www.webracks.com.br/resources/images/icones/bullet3.png'>
                    </img>
                    <a style='margin-left:15px' href='http://www.webracks.com.br/suportes-para-equip-aquaticos/0/7/'>Suportes Para Equip. Aquáticos</a>
                    <br/>
                    <img style='position:absolute; padding:6px 0 0 2px; width:auto;' src='http://www.webracks.com.br/resources/images/icones/bullet3.png'>
                    </img>
                    <a style='margin-left:15px' href='http://www.webracks.com.br/pecas-para-reposicao/1/8/'>Peças Para Reposição </a>
                    <br/>
                    <img style='position:absolute; padding:6px 0 0 2px; width:auto;' src='http://www.webracks.com.br/resources/images/icones/bullet3.png'>
                    </img>
                    <a style='margin-left:15px' href='http://www.webracks.com.br/rack-para-seu-carro/1/5/'>Rack Para Seu Carro </a>
                    <br/>
                    <img style='position:absolute; padding:6px 0 0 2px; width:auto;' src='http://www.webracks.com.br/resources/images/icones/bullet3.png'>
                    </img>
                    <a style='margin-left:15px' href='http://www.webracks.com.br/acessorios-para-racks-bagageiros-e-suportes/1/17/'>Acessórios Para Racks, Bagageiros e Suportes </a>
                    <br/>
                </div>
            </li>
            
            <li>
                <div class='menu-evento' onMouseOver='menuTipos(2,1);' onMouseOut='menuTipos(2,0);'>
                    <a href='http://www.webracks.com.br/viagens-transportes/2/'>Viagens & Transportes</a>
                </div>
                
                <div onMouseOver='menuTipos(2,1);' onMouseOut='menuTipos(2,0);' class='menu-hover' id='menu-hover-2'>
                    <img style='position:absolute; padding:6px 0 0 2px; width:auto;' src='http://www.webracks.com.br/resources/images/icones/bullet3.png'>
                    </img>
                    <a style='margin-left:15px' href='http://www.webracks.com.br/carrinhos-para-bebes/3/18/'>Carrinhos Para Bebes </a>
                    <br/>
                    <img style='position:absolute; padding:6px 0 0 2px; width:auto;' src='http://www.webracks.com.br/resources/images/icones/bullet3.png'>
                    </img>
                    <a style='margin-left:15px' href='http://www.webracks.com.br/organizadores/2/24/'>Organizadores </a>
                    <br/>
                    <img style='position:absolute; padding:6px 0 0 2px; width:auto;' src='http://www.webracks.com.br/resources/images/icones/bullet3.png'>
                    </img>
                    <a style='margin-left:15px' href='http://www.webracks.com.br/mochilas/2/15/'>Mochilas </a>
                    <br/>
                </div>
            </li>
            
            <li><div class='menu-evento' onMouseOver='menuTipos(3,1);' onMouseOut='menuTipos(3,0);'>
                                <a href='http://www.webracks.com.br/esporte-lazer/3/'>Esporte & Lazer</a>
                            </div><div onMouseOver='menuTipos(3,1);' onMouseOut='menuTipos(3,0);' class='menu-hover' id='menu-hover-3'><img style='position:absolute; padding:6px 0 0 2px; width:auto;' src='http://www.webracks.com.br/resources/images/icones/bullet3.png'></img><a style='margin-left:15px' href='http://www.webracks.com.br/carrinhos-para-bebes/3/18/'>Carrinhos Para Bebes </a><br/></div></li><li ><div class='menu-evento' onMouseOver='menuTipos(4,1);' onMouseOut='menuTipos(4,0);'>
                                <a href='http://www.webracks.com.br/relogios-monitores/4/'>Relógios & Monitores</a>
                            </div><div onMouseOver='menuTipos(4,1);' onMouseOut='menuTipos(4,0);' class='menu-hover' id='menu-hover-4'><img style='position:absolute; padding:6px 0 0 2px; width:auto;' src='http://www.webracks.com.br/resources/images/icones/bullet3.png'></img><a style='margin-left:15px' href='http://www.webracks.com.br/monitores-cardiacos/4/16/'>Monitores Cardiacos </a><br/></div></li><li ><div class='menu-evento' onMouseOver='menuTipos(5,1);' onMouseOut='menuTipos(5,0);'>
                                <a href='http://www.webracks.com.br/camping-praia/5/'>Camping & Praia</a>
                            </div><div onMouseOver='menuTipos(5,1);' onMouseOut='menuTipos(5,0);' class='menu-hover' id='menu-hover-5'><img style='position:absolute; padding:6px 0 0 2px; width:auto;' src='http://www.webracks.com.br/resources/images/icones/bullet3.png'></img><a style='margin-left:15px' href='http://www.webracks.com.br/caixas-e-coolers-termicos/5/11/'>Caixas e Coolers Térmicos </a><br/><img style='position:absolute; padding:6px 0 0 2px; width:auto;' src='http://www.webracks.com.br/resources/images/icones/bullet3.png'></img><a style='margin-left:15px' href='http://www.webracks.com.br/tendas-e-barracas/5/20/'>Tendas e Barracas </a><br/><img style='position:absolute; padding:6px 0 0 2px; width:auto;' src='http://www.webracks.com.br/resources/images/icones/bullet3.png'></img><a style='margin-left:15px' href='http://www.webracks.com.br/colchoes-inflaveis/5/21/'>Colchões Infláveis </a><br/><img style='position:absolute; padding:6px 0 0 2px; width:auto;' src='http://www.webracks.com.br/resources/images/icones/bullet3.png'></img><a style='margin-left:15px' href='http://www.webracks.com.br/mesas-e-cadeiras/5/2/'>Mesas e Cadeiras </a><br/><img style='position:absolute; padding:6px 0 0 2px; width:auto;' src='http://www.webracks.com.br/resources/images/icones/bullet3.png'></img><a style='margin-left:15px' href='http://www.webracks.com.br/acessorios-camping-praia/5/22/'>Acessórios Camping & Praia </a><br/></div></li>            
            <a href="http://www.webracks.com.br/rackcerto/">
                <li id="pecas">
                    <div style="color: #FFFFFF;font-weight: bold;margin-left: 121px;margin-top: 8px;position: absolute;">Racks e Suportes</div><br/>
                    <div style="color:white; font-size:11px; padding: 0 5px 5px 108px;margin-top:11px;">O Rack certo para seu carro</div>
                </li>
            </a>
        </ul>
    </div>
    
    <!-- Fim Departamentos --><?php }} ?>