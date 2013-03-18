{doctype()}
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta name="google-site-verification" content="pJJdEo6K8bKiryYfRJBZgtYwZ6y1_3mF1CetIWrBfCA" />
        <title>:.Webracks.:</title>
        {link_tag('resources/css/estilos.css')}
        {link_tag('resources/css/listagem.css')}
        {link_tag('resources/javascript/lib/coin-slider/coin-slider-styles.css')}
        {link_tag('resources/javascript/lib/jq-ui/css/ui-lightness/jquery-ui-1.8.16.custom.css')}        
        <meta name="keywords" content="racks,bagageiros,bagageiro,bagageiro teto,suporte, bicicleta, bicicleta infantil,bicicletas,mountain bike, prancha surf, suporte caiaque,suporte equipamentos aquáticos, rack carro, monitores cardíacos, monitor cardiaco, relógio monitor cardíaco"/>
        <script type="text/javascript" charset="ISO-8859-1" src="{base_url()}resources/javascript/lib/jquery.js"></script>
        <script type="text/javascript" charset="ISO-8859-1" src="{base_url()}resources/javascript/lib/coin-slider/coin-slider.min.js"></script>
        <script type="text/javascript" src="{base_url()}resources/javascript/lib/jq-ui/js/jquery-ui-1.8.16.custom.min.js"></script>
        {literal}
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
        {/literal}
    </head>
<body>