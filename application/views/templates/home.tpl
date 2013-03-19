{include file="header.tpl" title="Example Smarty Page" name="$Name"}        
    <div class='slider'>
        <div id='coin-slider'>            
            
            {foreach from = $slider item = rs}
                
            <a href='{$rs->url}' target='{$rs->target}'>
                <img src=http://www.webracks.com.br/banner.php?_s=65 />
                <span></span>
            </a>
                
            {/foreach}            
            
        </div>
    </div>
    <div id="center"> <!--INÍCIO CENTRO-->
        
<script type="text/javascript">
    function ValidaEmail(){
        
        if($('#nome').val() == "")
            alert('Informe um nome!');
        else if($('#email').val() == "")
            alert('Informe um E-mail!');
        else{
            var obj = eval("document.frmNews.email");
            var txt = obj.value;
            if ((txt.length != 0) && ((txt.indexOf("@") < 1) || (txt.indexOf('.') < 7))){
                alert('Digite um e-mail válido');
                obj.focus();
            }else{
                document.frmNews.submit();
            }
        }
    }
</script>

<div id="sb-left">
	
    <!-- DEPARTAMENTOS -->
    <div id="departamentos">
	  <ul>
			  </ul>
	</div>
    

    

    
    <!-- PREÇOS -->
    <div id="filtro_preco">
        <div class="titulo">Preços</div></td>
        <a href="http://www.webracks.com.br/preco/30-49/"><div class="n">R$ 30,00 a R$ 49,00</div></a>
        <a href="http://www.webracks.com.br/preco/50-99/"><div class="n">R$ 50,00 a R$ 99,00</div></a>
        <a href="http://www.webracks.com.br/preco/100-149/"><div class="n">R$ 100,00 a R$ 149,00</div></a>
        <a href="http://www.webracks.com.br/preco/150-199/"><div class="n">R$ 150,00 a R$ 199,00</div></a>
        <a href="http://www.webracks.com.br/preco/200-299/"><div class="n">R$ 200,00 a R$ 299,00</div></a>
        <a href="http://www.webracks.com.br/preco/acima-300/"><div class="n">Acima de R$ 300,00</div></a>
    </div>
    
    <div class="preco-slider">
        
        <label for="amount" style="color:gray;">Arraste para selecionar:</label>
        <input class="slider-input" type="text" id="amount" style="border:0; color:#1F5AB2; font-weight:bold; margin:5px 0 2px 0" />
        
        <div style="margin:0px 10px 0px 5px" id="slider-range"></div>
    </div>

    <div id="news">
        <form action="" method="POST" name="frmNews">
        <label class="labelnews"> Cadastre seu e-mail e receba</label>
         <label class="labelnews" style="margin-left:40px;"><b>novidades!</b></label>
         <br/><span class="labelnews"> &nbsp Nome:</span>
         <input class="lnews" type="text" name="nome" id="nome">
         <br/><span class="labelnews"> &nbsp E-mail:</span>
         <input class="lnews" type="text" name="email" id="email" />
        <input type="button" onclick="ValidaEmail();" name="bt-enviar" id="bt-newsenviar" value="Enviar" class="buttonnews" />
        </form>
    </div>
    
        
    <br />
    <br />
	<div id="informativo" align="center">
      <a href=http://www.webracks.com.br/rack-para-seu-carro/rack-completo/rack-completo-para-pick-up-bedrider-longlife/67/ target=_top><img style='margin-top:10px' src=http://www.webracks.com.br/banner.php?_c=41 alt=imagem title=LongLife BedRide></a><a href=http://www.webracks.com.br/tendas-e-barracas/4-pessoas/barraca-para-4-pessoas-luna-mor-3514-mor/146/ target=_top><img style='margin-top:10px' src=http://www.webracks.com.br/banner.php?_c=42 alt=imagem title=Barraca Mor 4 Pessoas></a><a href=http://www.webracks.com.br/suporte-para-bicicletas/para-tampa-traseira/suporte-para-2-bicicletas-9001-cyel/579/ target=_top><img style='margin-top:10px' src=http://www.webracks.com.br/banner.php?_c=45 alt=imagem title=Cyel 9001></a><a href=http://www.webracks.com.br/monitores-cardiacos/acessorios/transmissor-t31-coded-polar/423/ target=_top><img style='margin-top:10px' src=http://www.webracks.com.br/banner.php?_c=48 alt=imagem title=Transmissor T13 Coded></a></div>

</div>
        <div id="right">
<div class="anuncios">
      <a href=http://www.webracks.com.br/colchoes-inflaveis/king-size/colchao-inflavel-king-size-mor-9073-mor/143/ target=_top><img src=http://www.webracks.com.br/banner.php?_c=40 alt=imagem title=Colchão Mor King></a><a href=http://www.webracks.com.br/suportes-para-equip-aquaticos/para-pranchas-de-surf-e-standup/suporte-para-2-pranchas-de-surf-thule-double-decker-809-thule/110/ target=_top><img src=http://www.webracks.com.br/banner.php?_c=50 alt=imagem title=Thule Double Decker></a><a href=http://www.webracks.com.br/acessorios-camping-praia/entretenimento/frisbee-aloha-3660-mor/904/ target=_top><img src=http://www.webracks.com.br/banner.php?_c=46 alt=imagem title=Frisbee Mor></a><a href=http://www.webracks.com.br/acessorios-camping-praia/entretenimento/frescobol-aloha-3659-mor/903/ target=_top><img src=http://www.webracks.com.br/banner.php?_c=47 alt=imagem title=Frescobol Mor></a><a href=http://www.webracks.com.br/produtos/pesquisa.php?_q=capa+celular target=_top><img src=http://www.webracks.com.br/banner.php?_c=49 alt=imagem title=Capa Celular></a><a href=http://www.webracks.com.br/colchoes-inflaveis/infanto-juvenil/colchao-inflavel-infanto-juvenil-6355-mor/905/ target=_top><img src=http://www.webracks.com.br/banner.php?_c=51 alt=imagem title=Colchao Inflavel Infantil></a><a href=http://www.webracks.com.br/mesas-e-cadeiras/infantil/cadeira-dobravel-infantil-ursinho-2090-mor/910/ target=_top><img src=http://www.webracks.com.br/banner.php?_c=52 alt=imagem title=Cadeira Mor Ursinho></a>  </div>
    
</div>
	
        <div id="informativo" align="center">
        <a href=http://www.webracks.com.br/rackcerto/ target=_top><img src=http://www.webracks.com.br/banner.php?_c=32 alt=imagem title=Rack Para Seu Carro></a>        </div>
        
<div id="main"><!--INÍCIO ÁREA CENTRAL-->
    
        <br/>
    
		  <div id="listagem-h">
		      <div style='width:33%; float:left; min-width: 200px' >
		      <div class='item' style='margin-left:50%; left:-115px; position:relative;'>
		        
		        <div class="imagem"><div  class="etiquetinha"></div><a href="http://www.webracks.com.br/acessorios-camping-praia/piscinas-e-boias/piscina-1000-l-1002-mor/85/" title="Ver detalhes de &quot;Piscina 1000 L - 1002 - Mor&quot;"  > <img src="http://www.webracks.com.br/php/classes/imagem/img5.php?_a=000085001.jpg" alt="Ver detalhes de &quot;Piscina 1000 L - 1002 - Mor&quot;" title="Ver detalhes de &quot;Piscina 1000 L - 1002 - Mor&quot;"/></a></div>
		        <div class="info">
		          <a href="http://www.webracks.com.br/acessorios-camping-praia/piscinas-e-boias/piscina-1000-l-1002-mor/85/" title="Ver detalhes de &quot;Piscina 1000 L - 1002 - Mor&quot;"  class="std" > <b>Piscina 1000 L - 1002 - Mor</b></a><br />
		          Por: <span class="valor-por"><b>R$ 94,04</b><span style="color:#000"> à vista no boleto </span></span>
		           <br /> 
		          <span class="valor-parcelas">ou <b>6 X de R$ 16,50</b><span style="color:#000"> sem juros no cartão</span></span>
		        </div>
		        <div class="prontaentrega" title="Pronta Entrega"></div>
		        <a href="http://www.webracks.com.br/acessorios-camping-praia/piscinas-e-boias/piscina-1000-l-1002-mor/85/" title="Ver detalhes de &quot;Piscina 1000 L - 1002 - Mor&quot;"  class="mais-detalhes" > </a>
		      </div>
		      </div>
		      <div style='width:33%; float:left; min-width: 200px' >
		      <div class='item' style='margin-left:50%; left:-115px; position:relative;'>
		        
		        <div class="imagem"><div  class="etiquetinha"></div><a href="http://www.webracks.com.br/rack-para-seu-carro/rack-completo/rack-completo-de-aluminio-longlife-sport-ajet-longlife/496/" title="Ver detalhes de &quot;Rack Completo de Aluminio Longlife Sport - AJet - Longlife&quot;"  > <img src="http://www.webracks.com.br/php/classes/imagem/img5.php?_a=000451001.jpg" alt="Produzidos em alumínio os Racks Sport da Longlife são os melhores produzidos no Brasil. Possui uma instalação simples, um design aerodinâmico, com sistema de fixação em Aço Inox.   " title="Produzidos em alumínio os Racks Sport da Longlife são os melhores produzidos no Brasil. Possui uma instalação simples, um design aerodinâmico, com sistema de fixação em Aço Inox.   "/></a></div>
		        <div class="info">
		          <a href="http://www.webracks.com.br/rack-para-seu-carro/rack-completo/rack-completo-de-aluminio-longlife-sport-ajet-longlife/496/" title="Ver detalhes de &quot;Rack Completo de Aluminio Longlife Sport - AJet - Longlife&quot;"  class="std" > <b>Rack Completo de Aluminio Longlife Sport - AJet - Longlife</b></a><br />
		          Por: <span class="valor-por"><b>R$ 294,50</b><span style="color:#000"> à vista no boleto </span></span>
		           <br /> 
		          <span class="valor-parcelas">ou <b>6 X de R$ 51,67</b><span style="color:#000"> sem juros no cartão</span></span>
		        </div>
		        <div class="prontaentrega" title="Pronta Entrega"></div>
		        <a href="http://www.webracks.com.br/rack-para-seu-carro/rack-completo/rack-completo-de-aluminio-longlife-sport-ajet-longlife/496/" title="Ver detalhes de &quot;Rack Completo de Aluminio Longlife Sport - AJet - Longlife&quot;"  class="mais-detalhes" > </a>
		      </div>
		      </div>
		      <div style='width:33%; float:left; min-width: 200px' >
		      <div class='item' style='margin-left:50%; left:-115px; position:relative;'>
		        
		        <div class="imagem"><div  class="etiquetinha"></div><a href="http://www.webracks.com.br/rack-para-seu-carro/rack-completo/rack-completo-de-aluminio-longlife-sport-ac3-longlife/435/" title="Ver detalhes de &quot;Rack Completo de Aluminio Longlife Sport   - AC3 - Longlife&quot;"  > <img src="http://www.webracks.com.br/php/classes/imagem/img5.php?_a=000390001.jpg" alt="Produzidos em alumínio os Racks Sport da Longlife são os melhores produzidos no Brasil. Possui uma instalação simples, um design aerodinâmico, com sistema de fixação em Aço Inox.   " title="Produzidos em alumínio os Racks Sport da Longlife são os melhores produzidos no Brasil. Possui uma instalação simples, um design aerodinâmico, com sistema de fixação em Aço Inox.   "/></a></div>
		        <div class="info">
		          <a href="http://www.webracks.com.br/rack-para-seu-carro/rack-completo/rack-completo-de-aluminio-longlife-sport-ac3-longlife/435/" title="Ver detalhes de &quot;Rack Completo de Aluminio Longlife Sport   - AC3 - Longlife&quot;"  class="std" > <b>Rack Completo de Aluminio Longlife Sport   - AC3 - Longlife</b></a><br />
		          Por: <span class="valor-por"><b>R$ 331,55</b><span style="color:#000"> à vista no boleto </span></span>
		           <br /> 
		          <span class="valor-parcelas">ou <b>6 X de R$ 58,17</b><span style="color:#000"> sem juros no cartão</span></span>
		        </div>
		        <div class="prontaentrega" title="Pronta Entrega"></div>
		        <a href="http://www.webracks.com.br/rack-para-seu-carro/rack-completo/rack-completo-de-aluminio-longlife-sport-ac3-longlife/435/" title="Ver detalhes de &quot;Rack Completo de Aluminio Longlife Sport   - AC3 - Longlife&quot;"  class="mais-detalhes" > </a>
		      </div>
		      </div>
		      <div style='width:33%; float:left; min-width: 200px' >
		      <div class='item' style='margin-left:50%; left:-115px; position:relative;'>
		        
		        <div class="imagem"><div  class="etiquetinha"></div><a href="http://www.webracks.com.br/rack-para-seu-carro/kits-de-fixacao/kit-de-fixacao-thule-3042-thule/282/" title="Ver detalhes de &quot;Kit de Fixação Thule 3042 - Thule&quot;"  > <img src="http://www.webracks.com.br/php/classes/imagem/img5.php?_a=000252001.jpg" alt="O uso do Kit de fixação é necessário para que o rack de teto se fixe perfeitamente no carro, garantindo uma maior segurança e facilidade. Cada carro necessita de um modelo de kit especifico. " title="O uso do Kit de fixação é necessário para que o rack de teto se fixe perfeitamente no carro, garantindo uma maior segurança e facilidade. Cada carro necessita de um modelo de kit especifico. "/></a></div>
		        <div class="info">
		          <a href="http://www.webracks.com.br/rack-para-seu-carro/kits-de-fixacao/kit-de-fixacao-thule-3042-thule/282/" title="Ver detalhes de &quot;Kit de Fixação Thule 3042 - Thule&quot;"  class="std" > <b>Kit de Fixação Thule 3042 - Thule</b></a><br />
		          Por: <span class="valor-por"><b>R$ 160,55</b><span style="color:#000"> à vista no boleto </span></span>
		           <br /> 
		          <span class="valor-parcelas">ou <b>6 X de R$ 28,17</b><span style="color:#000"> sem juros no cartão</span></span>
		        </div>
		        <div class="prontaentrega" title="Pronta Entrega"></div>
		        <a href="http://www.webracks.com.br/rack-para-seu-carro/kits-de-fixacao/kit-de-fixacao-thule-3042-thule/282/" title="Ver detalhes de &quot;Kit de Fixação Thule 3042 - Thule&quot;"  class="mais-detalhes" > </a>
		      </div>
		      </div>
		      <div style='width:33%; float:left; min-width: 200px' >
		      <div class='item' style='margin-left:50%; left:-115px; position:relative;'>
		        
		        <img style='position:absolute; z-index:2; margin-left:150px; ' src='http://www.webracks.com.br/resources/images/botoes/etiqueta-frete-gratis.png'/><div class="imagem"><div style='margin:5px 0 0 5px' class="etiquetinha"></div><a href="http://www.webracks.com.br/monitores-cardiacos/para-academia/relogio-monitor-cardiaco-polar-ft4f-feminino-polar/121/" title="Ver detalhes de &quot;Relógio Monitor Cardíaco Polar FT4F - Feminino - Polar&quot;"  > <img src="http://www.webracks.com.br/php/classes/imagem/img5.php?_a=000121005.jpg" alt="Ver detalhes de &quot;Relógio Monitor Cardíaco Polar FT4F - Feminino - Polar&quot;" title="Ver detalhes de &quot;Relógio Monitor Cardíaco Polar FT4F - Feminino - Polar&quot;"/></a></div>
		        <div class="info">
		          <a href="http://www.webracks.com.br/monitores-cardiacos/para-academia/relogio-monitor-cardiaco-polar-ft4f-feminino-polar/121/" title="Ver detalhes de &quot;Relógio Monitor Cardíaco Polar FT4F - Feminino - Polar&quot;"  class="std" > <b>Relógio Monitor Cardíaco Polar FT4F - Feminino - Polar</b></a><br />
		          Por: <span class="valor-por"><b>R$ 436,05</b><span style="color:#000"> à vista no boleto </span></span>
		           <br /> 
		          <span class="valor-parcelas">ou <b>6 X de R$ 76,50</b><span style="color:#000"> sem juros no cartão</span></span>
		        </div>
		        <div class="prontaentrega" title="Pronta Entrega"></div>
		        <a href="http://www.webracks.com.br/monitores-cardiacos/para-academia/relogio-monitor-cardiaco-polar-ft4f-feminino-polar/121/" title="Ver detalhes de &quot;Relógio Monitor Cardíaco Polar FT4F - Feminino - Polar&quot;"  class="mais-detalhes" > </a>
		      </div>
		      </div>
		      <div style='width:33%; float:left; min-width: 200px' >
		      <div class='item' style='margin-left:50%; left:-115px; position:relative;'>
		        
		        <img style='position:absolute; z-index:2; margin-left:150px; ' src='http://www.webracks.com.br/resources/images/botoes/etiqueta-frete-gratis.png'/><div class="imagem"><div style='margin:5px 0 0 5px' class="etiquetinha"></div><a href="http://www.webracks.com.br/monitores-cardiacos/acessorios/elastico-eletrodo-soft-polar/429/" title="Ver detalhes de &quot;Elastico Eletrodo Soft - Polar&quot;"  > <img src="http://www.webracks.com.br/php/classes/imagem/img5.php?_a=000385001.jpg" alt="Ver detalhes de &quot;Elastico Eletrodo Soft - Polar&quot;" title="Ver detalhes de &quot;Elastico Eletrodo Soft - Polar&quot;"/></a></div>
		        <div class="info">
		          <a href="http://www.webracks.com.br/monitores-cardiacos/acessorios/elastico-eletrodo-soft-polar/429/" title="Ver detalhes de &quot;Elastico Eletrodo Soft - Polar&quot;"  class="std" > <b>Elastico Eletrodo Soft - Polar</b></a><br />
		          Por: <span class="valor-por"><b>R$ 71,25</b><span style="color:#000"> à vista no boleto </span></span>
		           <br /> 
		          <span class="valor-parcelas">ou <b>6 X de R$ 12,50</b><span style="color:#000"> sem juros no cartão</span></span>
		        </div>
		        <div class="prontaentrega" title="Pronta Entrega"></div>
		        <a href="http://www.webracks.com.br/monitores-cardiacos/acessorios/elastico-eletrodo-soft-polar/429/" title="Ver detalhes de &quot;Elastico Eletrodo Soft - Polar&quot;"  class="mais-detalhes" > </a>
		      </div>
		      </div>
		      <div style='width:33%; float:left; min-width: 200px' >
		      <div class='item' style='margin-left:50%; left:-115px; position:relative;'>
		        
		        <div class="imagem"><div  class="etiquetinha"></div><a href="http://www.webracks.com.br/rack-para-seu-carro/kits-de-fixacao/kit-de-fixacao-thule-4009-thule/263/" title="Ver detalhes de &quot;Kit de Fixação Thule 4009 - Thule&quot;"  > <img src="http://www.webracks.com.br/php/classes/imagem/img5.php?_a=000233001.jpg" alt="O uso do Kit de fixação é necessário para que o rack de teto se fixe perfeitamente no carro, garantindo uma maior segurança e facilidade. Cada carro necessita de um modelo de kit especifico. " title="O uso do Kit de fixação é necessário para que o rack de teto se fixe perfeitamente no carro, garantindo uma maior segurança e facilidade. Cada carro necessita de um modelo de kit especifico. "/></a></div>
		        <div class="info">
		          <a href="http://www.webracks.com.br/rack-para-seu-carro/kits-de-fixacao/kit-de-fixacao-thule-4009-thule/263/" title="Ver detalhes de &quot;Kit de Fixação Thule 4009 - Thule&quot;"  class="std" > <b>Kit de Fixação Thule 4009 - Thule</b></a><br />
		          Por: <span class="valor-por"><b>R$ 160,55</b><span style="color:#000"> à vista no boleto </span></span>
		           <br /> 
		          <span class="valor-parcelas">ou <b>6 X de R$ 28,17</b><span style="color:#000"> sem juros no cartão</span></span>
		        </div>
		        <div class="prontaentrega" title="Pronta Entrega"></div>
		        <a href="http://www.webracks.com.br/rack-para-seu-carro/kits-de-fixacao/kit-de-fixacao-thule-4009-thule/263/" title="Ver detalhes de &quot;Kit de Fixação Thule 4009 - Thule&quot;"  class="mais-detalhes" > </a>
		      </div>
		      </div>
		      <div style='width:33%; float:left; min-width: 200px' >
		      <div class='item' style='margin-left:50%; left:-115px; position:relative;'>
		        
		        <div class="imagem"><div  class="etiquetinha"></div><a href="http://www.webracks.com.br/suporte-para-bicicletas/para-teto/suporte-para-1-bicicleta-longlife-autobike-longlife/32/" title="Ver detalhes de &quot;Suporte Para 1 Bicicleta Longlife AutoBike - Longlife&quot;"  > <img src="http://www.webracks.com.br/php/classes/imagem/img5.php?_a=000032005.jpg" alt="Ver detalhes de &quot;Suporte Para 1 Bicicleta Longlife AutoBike - Longlife&quot;" title="Ver detalhes de &quot;Suporte Para 1 Bicicleta Longlife AutoBike - Longlife&quot;"/></a></div>
		        <img style='position:absolute; margin-left:125px' src='http://www.webracks.com.br/resources/images/icones/estrelas-pqn/estrela-5.png' />
		        <div class="info">
		          <a href="http://www.webracks.com.br/suporte-para-bicicletas/para-teto/suporte-para-1-bicicleta-longlife-autobike-longlife/32/" title="Ver detalhes de &quot;Suporte Para 1 Bicicleta Longlife AutoBike - Longlife&quot;"  class="std" > <b>Suporte Para 1 Bicicleta Longlife AutoBike - Longlife</b></a><br />
		          Por: <span class="valor-por"><b>R$ 189,05</b><span style="color:#000"> à vista no boleto </span></span>
		           <br /> 
		          <span class="valor-parcelas">ou <b>6 X de R$ 33,17</b><span style="color:#000"> sem juros no cartão</span></span>
		        </div>
		        <div class="prontaentrega" title="Pronta Entrega"></div>
		        <a href="http://www.webracks.com.br/suporte-para-bicicletas/para-teto/suporte-para-1-bicicleta-longlife-autobike-longlife/32/" title="Ver detalhes de &quot;Suporte Para 1 Bicicleta Longlife AutoBike - Longlife&quot;"  class="mais-detalhes" > </a>
		      </div>
		      </div>
		      <div style='width:33%; float:left; min-width: 200px' >
		      <div class='item' style='margin-left:50%; left:-115px; position:relative;'>
		        
		        <div class="imagem"><div  class="etiquetinha"></div><a href="http://www.webracks.com.br/mesas-e-cadeiras/infantil/cadeira-dobravel-infantil-ursinho-2090-mor/910/" title="Ver detalhes de &quot;Cadeira Dobravel Infantil Ursinho - 2090 - Mor&quot;"  > <img src="http://www.webracks.com.br/php/classes/imagem/img5.php?_a=000571001.jpg" alt="Ver detalhes de &quot;Cadeira Dobravel Infantil Ursinho - 2090 - Mor&quot;" title="Ver detalhes de &quot;Cadeira Dobravel Infantil Ursinho - 2090 - Mor&quot;"/></a></div>
		        <div class="info">
		          <a href="http://www.webracks.com.br/mesas-e-cadeiras/infantil/cadeira-dobravel-infantil-ursinho-2090-mor/910/" title="Ver detalhes de &quot;Cadeira Dobravel Infantil Ursinho - 2090 - Mor&quot;"  class="std" > <b>Cadeira Dobravel Infantil Ursinho - 2090 - Mor</b></a><br />
		          Por: <span class="valor-por"><b>R$ 42,75</b><span style="color:#000"> à vista no boleto </span></span>
		           <br /> 
		          <span class="valor-parcelas">ou <b>6 X de R$ 7,50</b><span style="color:#000"> sem juros no cartão</span></span>
		        </div>
		        <div class="prontaentrega" title="Pronta Entrega"></div>
		        <a href="http://www.webracks.com.br/mesas-e-cadeiras/infantil/cadeira-dobravel-infantil-ursinho-2090-mor/910/" title="Ver detalhes de &quot;Cadeira Dobravel Infantil Ursinho - 2090 - Mor&quot;"  class="mais-detalhes" > </a>
		      </div>
		      </div>
		      <div style='width:33%; float:left; min-width: 200px' >
		      <div class='item' style='margin-left:50%; left:-115px; position:relative;'>
		        
		        <div class="imagem"><div  class="etiquetinha"></div><a href="http://www.webracks.com.br/rack-para-seu-carro/rack-completo/rack-completo-de-aluminio-longlife-sport-ac4h-longlife/436/" title="Ver detalhes de &quot;Rack Completo de Aluminio Longlife Sport   - AC4H - Longlife&quot;"  > <img src="http://www.webracks.com.br/php/classes/imagem/img5.php?_a=000391001.jpg" alt="Produzidos em alumínio os Racks Sport da Longlife são os melhores produzidos no Brasil. Possui uma instalação simples, um design aerodinâmico, com sistema de fixação em Aço Inox.   " title="Produzidos em alumínio os Racks Sport da Longlife são os melhores produzidos no Brasil. Possui uma instalação simples, um design aerodinâmico, com sistema de fixação em Aço Inox.   "/></a></div>
		        <img style='position:absolute; margin-left:125px' src='http://www.webracks.com.br/resources/images/icones/estrelas-pqn/estrela-5.png' />
		        <div class="info">
		          <a href="http://www.webracks.com.br/rack-para-seu-carro/rack-completo/rack-completo-de-aluminio-longlife-sport-ac4h-longlife/436/" title="Ver detalhes de &quot;Rack Completo de Aluminio Longlife Sport   - AC4H - Longlife&quot;"  class="std" > <b>Rack Completo de Aluminio Longlife Sport   - AC4H - Longlife</b></a><br />
		          Por: <span class="valor-por"><b>R$ 331,55</b><span style="color:#000"> à vista no boleto </span></span>
		           <br /> 
		          <span class="valor-parcelas">ou <b>6 X de R$ 58,17</b><span style="color:#000"> sem juros no cartão</span></span>
		        </div>
		        <div class="prontaentrega" title="Pronta Entrega"></div>
		        <a href="http://www.webracks.com.br/rack-para-seu-carro/rack-completo/rack-completo-de-aluminio-longlife-sport-ac4h-longlife/436/" title="Ver detalhes de &quot;Rack Completo de Aluminio Longlife Sport   - AC4H - Longlife&quot;"  class="mais-detalhes" > </a>
		      </div>
		      </div>
		      <div style='width:33%; float:left; min-width: 200px' >
		      <div class='item' style='margin-left:50%; left:-115px; position:relative;'>
		        
		        <div class="imagem"><div  class="etiquetinha"></div><a href="http://www.webracks.com.br/rack-para-seu-carro/rack-completo/rack-completo-para-pick-up-bedrider-longlife/576/" title="Ver detalhes de &quot;Rack Completo Para Pick-Up BedRider - Longlife&quot;"  > <img src="http://www.webracks.com.br/php/classes/imagem/img5.php?_a=000067003.jpg" alt="Ver detalhes de &quot;Rack Completo Para Pick-Up BedRider - Longlife&quot;" title="Ver detalhes de &quot;Rack Completo Para Pick-Up BedRider - Longlife&quot;"/></a></div>
		        <div class="info">
		          <a href="http://www.webracks.com.br/rack-para-seu-carro/rack-completo/rack-completo-para-pick-up-bedrider-longlife/576/" title="Ver detalhes de &quot;Rack Completo Para Pick-Up BedRider - Longlife&quot;"  class="std" > <b>Rack Completo Para Pick-Up BedRider - Longlife</b></a><br />
		          Por: <span class="valor-por"><b>R$ 379,05</b><span style="color:#000"> à vista no boleto </span></span>
		           <br /> 
		          <span class="valor-parcelas">ou <b>6 X de R$ 66,50</b><span style="color:#000"> sem juros no cartão</span></span>
		        </div>
		        <div class="prontaentrega" title="Pronta Entrega"></div>
		        <a href="http://www.webracks.com.br/rack-para-seu-carro/rack-completo/rack-completo-para-pick-up-bedrider-longlife/576/" title="Ver detalhes de &quot;Rack Completo Para Pick-Up BedRider - Longlife&quot;"  class="mais-detalhes" > </a>
		      </div>
		      </div>
		      <div style='width:33%; float:left; min-width: 200px' >
		      <div class='item' style='margin-left:50%; left:-115px; position:relative;'>
		        
		        <div class="imagem"><div  class="etiquetinha"></div><a href="http://www.webracks.com.br/acessorios-para-racks-bagageiros-e-suportes/adaptadores-e-tomadas/adaptador-de-quadro-thule-frame-982-thule/72/" title="Ver detalhes de &quot;Adaptador de Quadro Thule Frame 982 - Thule&quot;"  > <img src="http://www.webracks.com.br/php/classes/imagem/img5.php?_a=000072001.jpg" alt="Ver detalhes de &quot;Adaptador de Quadro Thule Frame 982 - Thule&quot;" title="Ver detalhes de &quot;Adaptador de Quadro Thule Frame 982 - Thule&quot;"/></a></div>
		        <div class="info">
		          <a href="http://www.webracks.com.br/acessorios-para-racks-bagageiros-e-suportes/adaptadores-e-tomadas/adaptador-de-quadro-thule-frame-982-thule/72/" title="Ver detalhes de &quot;Adaptador de Quadro Thule Frame 982 - Thule&quot;"  class="std" > <b>Adaptador de Quadro Thule Frame 982 - Thule</b></a><br />
		          Por: <span class="valor-por"><b>R$ 103,55</b><span style="color:#000"> à vista no boleto </span></span>
		           <br /> 
		          <span class="valor-parcelas">ou <b>6 X de R$ 18,17</b><span style="color:#000"> sem juros no cartão</span></span>
		        </div>
		        <div class="prontaentrega" title="Pronta Entrega"></div>
		        <a href="http://www.webracks.com.br/acessorios-para-racks-bagageiros-e-suportes/adaptadores-e-tomadas/adaptador-de-quadro-thule-frame-982-thule/72/" title="Ver detalhes de &quot;Adaptador de Quadro Thule Frame 982 - Thule&quot;"  class="mais-detalhes" > </a>
		      </div>
		      </div>
		      <div style='width:33%; float:left; min-width: 200px' >
		      <div class='item' style='margin-left:50%; left:-115px; position:relative;'>
		        
		        <div class="imagem"><div  class="etiquetinha"></div><a href="http://www.webracks.com.br/caixas-e-coolers-termicos/caixas/cooler-victory-51-litros-rubbermaid/955/" title="Ver detalhes de &quot;Cooler Victory 51 litros - Rubbermaid&quot;"  > <img src="http://www.webracks.com.br/php/classes/imagem/img5.php?_a=000600003.jpg" alt="Ver detalhes de &quot;Cooler Victory 51 litros - Rubbermaid&quot;" title="Ver detalhes de &quot;Cooler Victory 51 litros - Rubbermaid&quot;"/></a></div>
		        <div class="info">
		          <a href="http://www.webracks.com.br/caixas-e-coolers-termicos/caixas/cooler-victory-51-litros-rubbermaid/955/" title="Ver detalhes de &quot;Cooler Victory 51 litros - Rubbermaid&quot;"  class="std" > <b>Cooler Victory 51 litros - Rubbermaid</b></a><br />
		          Por: <span class="valor-por"><b>R$ 284,05</b><span style="color:#000"> à vista no boleto </span></span>
		           <br /> 
		          <span class="valor-parcelas">ou <b>6 X de R$ 49,83</b><span style="color:#000"> sem juros no cartão</span></span>
		        </div>
		        <div class="prontaentrega" title="Pronta Entrega"></div>
		        <a href="http://www.webracks.com.br/caixas-e-coolers-termicos/caixas/cooler-victory-51-litros-rubbermaid/955/" title="Ver detalhes de &quot;Cooler Victory 51 litros - Rubbermaid&quot;"  class="mais-detalhes" > </a>
		      </div>
		      </div>
		      <div style='width:33%; float:left; min-width: 200px' >
		      <div class='item' style='margin-left:50%; left:-115px; position:relative;'>
		        
		        <div class="imagem"><div  class="etiquetinha"></div><a href="http://www.webracks.com.br/caixas-e-coolers-termicos/bolsas/bolsa-termica-mor-24-litros-3621-mor/99/" title="Ver detalhes de &quot;Bolsa Térmica Mor 24 Litros - 3621 - Mor&quot;"  > <img src="http://www.webracks.com.br/php/classes/imagem/img5.php?_a=000099004.jpg" alt="Ver detalhes de &quot;Bolsa Térmica Mor 24 Litros - 3621 - Mor&quot;" title="Ver detalhes de &quot;Bolsa Térmica Mor 24 Litros - 3621 - Mor&quot;"/></a></div>
		        <div class="info">
		          <a href="http://www.webracks.com.br/caixas-e-coolers-termicos/bolsas/bolsa-termica-mor-24-litros-3621-mor/99/" title="Ver detalhes de &quot;Bolsa Térmica Mor 24 Litros - 3621 - Mor&quot;"  class="std" > <b>Bolsa Térmica Mor 24 Litros - 3621 - Mor</b></a><br />
		          Por: <span class="valor-por"><b>R$ 47,41</b><span style="color:#000"> à vista no boleto </span></span>
		           <br /> 
		          <span class="valor-parcelas">ou <b>6 X de R$ 8,32</b><span style="color:#000"> sem juros no cartão</span></span>
		        </div>
		        <div class="prontaentrega" title="Pronta Entrega"></div>
		        <a href="http://www.webracks.com.br/caixas-e-coolers-termicos/bolsas/bolsa-termica-mor-24-litros-3621-mor/99/" title="Ver detalhes de &quot;Bolsa Térmica Mor 24 Litros - 3621 - Mor&quot;"  class="mais-detalhes" > </a>
		      </div>
		      </div>
		      <div style='width:33%; float:left; min-width: 200px' >
		      <div class='item' style='margin-left:50%; left:-115px; position:relative;'>
		        
		        <div class="imagem"><div  class="etiquetinha"></div><a href="http://www.webracks.com.br/acessorios-camping-praia/guarda-sol/guarda-sol-azul-180x180cm-3717-mor/921/" title="Ver detalhes de &quot;Guarda Sol Azul 180X180CM - 3717 - Mor&quot;"  > <img src="http://www.webracks.com.br/php/classes/imagem/img5.php?_a=000575001.jpg" alt="Ver detalhes de &quot;Guarda Sol Azul 180X180CM - 3717 - Mor&quot;" title="Ver detalhes de &quot;Guarda Sol Azul 180X180CM - 3717 - Mor&quot;"/></a></div>
		        <div class="info">
		          <a href="http://www.webracks.com.br/acessorios-camping-praia/guarda-sol/guarda-sol-azul-180x180cm-3717-mor/921/" title="Ver detalhes de &quot;Guarda Sol Azul 180X180CM - 3717 - Mor&quot;"  class="std" > <b>Guarda Sol Azul 180X180CM - 3717 - Mor</b></a><br />
		          Por: <span class="valor-por"><b>R$ 20,90</b><span style="color:#000"> à vista no boleto </span></span>
		           <br /> 
		          <span class="valor-parcelas">ou <b>6 X de R$ 3,67</b><span style="color:#000"> sem juros no cartão</span></span>
		        </div>
		        <div class="prontaentrega" title="Pronta Entrega"></div>
		        <a href="http://www.webracks.com.br/acessorios-camping-praia/guarda-sol/guarda-sol-azul-180x180cm-3717-mor/921/" title="Ver detalhes de &quot;Guarda Sol Azul 180X180CM - 3717 - Mor&quot;"  class="mais-detalhes" > </a>
		      </div>
		      </div>
		      <div style='width:33%; float:left; min-width: 200px' >
		      <div class='item' style='margin-left:50%; left:-115px; position:relative;'>
		        
		        <div class="imagem"><div  class="etiquetinha"></div><a href="http://www.webracks.com.br/mesas-e-cadeiras/infantil/cadeira-alta-infantil-ecologica-fadinha-2031-mor/140/" title="Ver detalhes de &quot;Cadeira Alta Infantil Ecológica Fadinha - 2031 - Mor&quot;"  > <img src="http://www.webracks.com.br/php/classes/imagem/img5.php?_a=000140001.jpg" alt="Ver detalhes de &quot;Cadeira Alta Infantil Ecológica Fadinha - 2031 - Mor&quot;" title="Ver detalhes de &quot;Cadeira Alta Infantil Ecológica Fadinha - 2031 - Mor&quot;"/></a></div>
		        <div class="info">
		          <a href="http://www.webracks.com.br/mesas-e-cadeiras/infantil/cadeira-alta-infantil-ecologica-fadinha-2031-mor/140/" title="Ver detalhes de &quot;Cadeira Alta Infantil Ecológica Fadinha - 2031 - Mor&quot;"  class="std" > <b>Cadeira Alta Infantil Ecológica Fadinha - 2031 - Mor</b></a><br />
		          Por: <span class="valor-por"><b>R$ 37,99</b><span style="color:#000"> à vista no boleto </span></span>
		           <br /> 
		          <span class="valor-parcelas">ou <b>6 X de R$ 6,67</b><span style="color:#000"> sem juros no cartão</span></span>
		        </div>
		        <div class="prontaentrega" title="Pronta Entrega"></div>
		        <a href="http://www.webracks.com.br/mesas-e-cadeiras/infantil/cadeira-alta-infantil-ecologica-fadinha-2031-mor/140/" title="Ver detalhes de &quot;Cadeira Alta Infantil Ecológica Fadinha - 2031 - Mor&quot;"  class="mais-detalhes" > </a>
		      </div>
		      </div>
		      <div style='width:33%; float:left; min-width: 200px' >
		      <div class='item' style='margin-left:50%; left:-115px; position:relative;'>
		        
		        <div class="imagem"><div  class="etiquetinha"></div><a href="http://www.webracks.com.br/rack-para-seu-carro/rack-completo/rack-completo-de-aluminio-longlife-sport-ac4p-longlife/433/" title="Ver detalhes de &quot;Rack Completo de Aluminio Longlife Sport  - AC4P - Longlife&quot;"  > <img src="http://www.webracks.com.br/php/classes/imagem/img5.php?_a=000388001.jpg" alt="Produzidos em alumínio os Racks Sport da Longlife são os melhores produzidos no Brasil. Possui uma instalação simples, um design aerodinâmico, com sistema de fixação em Aço Inox.   " title="Produzidos em alumínio os Racks Sport da Longlife são os melhores produzidos no Brasil. Possui uma instalação simples, um design aerodinâmico, com sistema de fixação em Aço Inox.   "/></a></div>
		        <div class="info">
		          <a href="http://www.webracks.com.br/rack-para-seu-carro/rack-completo/rack-completo-de-aluminio-longlife-sport-ac4p-longlife/433/" title="Ver detalhes de &quot;Rack Completo de Aluminio Longlife Sport  - AC4P - Longlife&quot;"  class="std" > <b>Rack Completo de Aluminio Longlife Sport  - AC4P - Longlife</b></a><br />
		          Por: <span class="valor-por"><b>R$ 331,55</b><span style="color:#000"> à vista no boleto </span></span>
		           <br /> 
		          <span class="valor-parcelas">ou <b>6 X de R$ 58,17</b><span style="color:#000"> sem juros no cartão</span></span>
		        </div>
		        <div class="prontaentrega" title="Pronta Entrega"></div>
		        <a href="http://www.webracks.com.br/rack-para-seu-carro/rack-completo/rack-completo-de-aluminio-longlife-sport-ac4p-longlife/433/" title="Ver detalhes de &quot;Rack Completo de Aluminio Longlife Sport  - AC4P - Longlife&quot;"  class="mais-detalhes" > </a>
		      </div>
		      </div>
		      <div style='width:33%; float:left; min-width: 200px' >
		      <div class='item' style='margin-left:50%; left:-115px; position:relative;'>
		        
		        <div class="imagem"><div  class="etiquetinha"></div><a href="http://www.webracks.com.br/tendas-e-barracas/3-pessoas/barraca-para-3-pessoas-luna-mor-3513-mor/145/" title="Ver detalhes de &quot;Barraca Para 3 Pessoas Luna Mor - 3513 - Mor&quot;"  > <img src="http://www.webracks.com.br/php/classes/imagem/img5.php?_a=000145005.jpg" alt="Ver detalhes de &quot;Barraca Para 3 Pessoas Luna Mor - 3513 - Mor&quot;" title="Ver detalhes de &quot;Barraca Para 3 Pessoas Luna Mor - 3513 - Mor&quot;"/></a></div>
		        <div class="info">
		          <a href="http://www.webracks.com.br/tendas-e-barracas/3-pessoas/barraca-para-3-pessoas-luna-mor-3513-mor/145/" title="Ver detalhes de &quot;Barraca Para 3 Pessoas Luna Mor - 3513 - Mor&quot;"  class="std" > <b>Barraca Para 3 Pessoas Luna Mor - 3513 - Mor</b></a><br />
		          Por: <span class="valor-por"><b>R$ 123,49</b><span style="color:#000"> à vista no boleto </span></span>
		           <br /> 
		          <span class="valor-parcelas">ou <b>6 X de R$ 21,67</b><span style="color:#000"> sem juros no cartão</span></span>
		        </div>
		        <div class="prontaentrega" title="Pronta Entrega"></div>
		        <a href="http://www.webracks.com.br/tendas-e-barracas/3-pessoas/barraca-para-3-pessoas-luna-mor-3513-mor/145/" title="Ver detalhes de &quot;Barraca Para 3 Pessoas Luna Mor - 3513 - Mor&quot;"  class="mais-detalhes" > </a>
		      </div>
		      </div>
		  </div>
    
</div><!--FIM ÁREA CENTRAL-->
    </div>

{include file="footer.tpl"}
