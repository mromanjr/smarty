<?php /* Smarty version Smarty 3.1.4, created on 2013-03-22 20:21:04
         compiled from "application/views/templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:258285148aeb53d5118-05601689%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd304e7d7913bc61a5ba57117e97d53a86f77f79d' => 
    array (
      0 => 'application/views/templates/header.tpl',
      1 => 1363983663,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '258285148aeb53d5118-05601689',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5148aeb57481b',
  'variables' => 
  array (
    'title' => 0,
    'logo' => 0,
    'menu' => 0,
    'i' => 0,
    'rs' => 0,
    'ItensMenu' => 0,
    'itens' => 0,
    'Item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5148aeb57481b')) {function content_5148aeb57481b($_smarty_tpl) {?><?php echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";?>

<?php echo doctype();?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta name="google-site-verification" content="pJJdEo6K8bKiryYfRJBZgtYwZ6y1_3mF1CetIWrBfCA" />
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <?php echo link_tag('resources/css/estilos.css');?>

        <?php echo link_tag('resources/css/listagem.css');?>

        <?php echo link_tag('resources/javascript/lib/coin-slider/coin-slider-styles.css');?>

        <?php echo link_tag('resources/javascript/lib/jq-ui/css/ui-lightness/jquery-ui-1.8.16.custom.css');?>
        
        <meta name="keywords" content="racks,bagageiros,bagageiro,bagageiro teto,suporte, bicicleta, bicicleta infantil,bicicletas,mountain bike, prancha surf, suporte caiaque,suporte equipamentos aquÃ¡ticos, rack carro, monitores cardÃ­acos, monitor cardiaco, relÃ³gio monitor cardÃ­aco"/>
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
                        
                        location.href="<?php echo base_url();?>
preco/"+ui.values[0]+"-"+ui.values[1]+"/";
                        
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
    <!--INÃCIO CONTAINER-->	
    <!--[if lte IE 7]>
        <div style='background-color:#FFFEE0;font-size:12px;text-align:center;margin-bottom:5px'>
        <b>Esta versÃ£o do navegador estÃ¡ desatualizada.</b><br />
        Para navegar neste site com maior seguranÃ§a, recomendamos utilizar o
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
    
    <!--INÃCIO TOPO-->
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
                <?php echo anchor(base_url(),img($_smarty_tpl->tpl_vars['logo']->value));?>

            </div>

            <div id="telefone">
                Vendas <b>(11) 4491-3051</b>
            </div>
            <div id="saudacao">
                OlÃ¡ visitante! <?php echo anchor((base_url()).('clientes'),'Identifique-se aqui');?>

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
                <div style='color:#555; font-size:11px; position:absolute; padding:0 10px 0 70px'>ColchÃ£o InflÃ¡vel Infanto Juvenil  - 6355 - Mor</div>
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
            <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['menu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value){
$_smarty_tpl->tpl_vars['rs']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['rs']->key;
?>
            <li>                
                    <div class='menu-evento' onMouseOver='menuTipos(<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
,1);' onMouseOut='menuTipos(<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
,0);'>
                        <a href='<?php echo (((base_url()).(UrlAmigavelReplace($_smarty_tpl->tpl_vars['rs']->value->departamento))).("/")).($_smarty_tpl->tpl_vars['rs']->value->codcolecao);?>
'>
                            <?php echo $_smarty_tpl->tpl_vars['rs']->value->departamento;?>

                        </a>
                    </div>     
                        
                    <div class='menu-hover' onMouseOver='menuTipos(<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
,1);' onMouseOut='menuTipos(<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
,0);' id="menu-hover-<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
">
                    
                        <?php  $_smarty_tpl->tpl_vars['itens'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['itens']->_loop = false;
 $_smarty_tpl->tpl_vars['iItens'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ItensMenu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['itens']->key => $_smarty_tpl->tpl_vars['itens']->value){
$_smarty_tpl->tpl_vars['itens']->_loop = true;
 $_smarty_tpl->tpl_vars['iItens']->value = $_smarty_tpl->tpl_vars['itens']->key;
?>
                            <?php  $_smarty_tpl->tpl_vars['Item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['Item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['itens']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['Item']->key => $_smarty_tpl->tpl_vars['Item']->value){
$_smarty_tpl->tpl_vars['Item']->_loop = true;
?>
                                <?php if ($_smarty_tpl->tpl_vars['Item']->value->codcolecao==$_smarty_tpl->tpl_vars['rs']->value->codcolecao){?>
                            <img style='position:absolute; padding:6px 0 0 2px; width:auto;' src='<?php echo base_url();?>
resources/images/icones/bullet3.png'></img>
                            <a href="<?php echo (((((base_url()).(UrlAmigavelReplace($_smarty_tpl->tpl_vars['Item']->value->tipoproduto))).("/")).($_smarty_tpl->tpl_vars['Item']->value->codcolecao)).("/")).($_smarty_tpl->tpl_vars['Item']->value->codtipoproduto);?>
" style='margin-left:15px'>
                                   <?php echo $_smarty_tpl->tpl_vars['Item']->value->tipoproduto;?>

                            </a>
                            <br>
                                <?php }?>
                            <?php } ?>
                         <?php } ?>                    
                    </div>
            </li>
            <?php } ?>
            
            <a href="http://www.webracks.com.br/rackcerto/">
                <li id="pecas">
                    <div style="color: #FFFFFF;font-weight: bold;margin-left: 121px;margin-top: 8px;position: absolute;">Racks e Suportes</div><br/>
                    <div style="color:white; font-size:11px; padding: 0 5px 5px 108px;margin-top:11px;">O Rack certo para seu carro</div>
                </li>
            </a>
        </ul>
    </div>
    
    <!-- Fim Departamentos --><?php }} ?>