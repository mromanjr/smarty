<?php 
/* 
 * -------------------------------------------------------------------------------
 * Classe CarrinhoCompras
 * 	Gerencia o carrinho de compras
 * -------------------------------------------------------------------------------
 * Criado em....: 22/10/2007
 * Alterado em..: 08/08/2012
 * -------------------------------------------------------------------------------
 */

class Carrinho_Compras extends CI_Model{
    
    const TIPO_ENTREGA_SEDEX = 1;
    const TIPO_ENTREGA_PAC = 2;
    const TIPO_ENTREGA_RETIRALOJA = 3;
    const TIPO_ENTREGA_GRATIS = 4;
    const TIPO_ENTREGA_TRANSPORTADORA = 5;
	const TIPO_ENTREGA_E_SEDEX = 6;
	const TIPO_ENTREGA_SEDEX_10 = 7;
	const TIPO_ENTREGA_PROPRIO = 8;
	
    var $aItens;
    var $aConfig;
    var $aErrors;

    function __constructor() {
        $this->CarrinhoCompras();
    }

    function CarrinhoCompras() {
        $this->_reset();
    }

    //---------------------------------------------------------------------------

    function getConfig($sKey) {
        return $this->aConfig[$sKey];
    }

    function setConfig($sKey, $mValue) {
        
        /* COM A IMPLANTAÇÃO DO COOKIE - INVIABILIZOU A VERIFICAÇÃO ABAIXO */
        /*if (!array_key_exists($sKey, $this->aConfig))
            return false;
        */
        
        $this->aConfig[$sKey] = $mValue;

        switch ($sKey) {
            
            case "codformapagto":
                $this->calculaDiferenca($mValue);
                $this->calculaParcela($mValue);
                break;

            case "cep":
                
                if (TEM_FAIXA_FRETE === false) {
                    $mValue = str_replace("-", "", $mValue);
                }

                if (false != $mValue){
                    $this->calculaFrete($mValue);
                }
                
                $this->calculaParcela($this->getConfig("codformapagto"));
                break;

            case "tipo_entrega":
                if (!in_array($mValue, array(self::TIPO_ENTREGA_SEDEX, self::TIPO_ENTREGA_E_SEDEX,self::TIPO_ENTREGA_PAC, self::TIPO_ENTREGA_RETIRALOJA, self::TIPO_ENTREGA_GRATIS, self::TIPO_ENTREGA_TRANSPORTADORA, self::TIPO_ENTREGA_SEDEX_10, self::TIPO_ENTREGA_PROPRIO))){
                    
                    //if(TEM_FAIXAS_CEP === true && $this->getConfig("cep") != ""){
                        
                    //    $this->setConfig("tipo_entrega", verificaTipoGratis() );
                    //}else{
                        $this->setConfig("tipo_entrega", self::TIPO_ENTREGA_SEDEX);
                    //}
                }
                    
                break;
        }

        return $mValue;
    }

    function isSimulacao() {
        return $this->getConfig("modo_simulacao");
    }

    function isVerificado() {
        return $this->getConfig("verificado");
    }

    function ready4Commit() {
        return $this->getConfig("verificado") && $this->getConfig("commit_ok");
    }

    function validate4Commit() {
        
        $this->aErrors = array();
        
        /*  Verifica se o carrinho foi validado. */
        if (!$this->isVerificado())
            $this->addError("Seu carrinho não foi validado para finalizar a compra! Acesse o carrinho novamente, confirme as informações e clique em &quot;Finalizar compra&quot;.");

        extract($this->aConfig, EXTR_PREFIX_ALL, "config");
        
        //die(print_r($this->aConfig));
        
        /**
         * Verifica se a pessoa está logada corretamente e é um cliente.
         */
        if ( (empty($config_codpessoa) || empty($config_codcliente)) && TEM_ONEPAGE_CHECKOUT === false)
            $this->addError("Seu login não foi efetuado corretamente para finalizar a compra!");

        /**
         * Verifica se a forma de pagamento foi selecionada.
         */
        if (empty($config_codformapagto) || 0 == $config_codformapagto)
            $this->addError("Nenhuma forma de pagamento foi selecionada!");

        /**
         * Verifica se o endereço de entrega foi informado.
         */
        
        if (( empty($config_codendereco) || 0 == $config_codendereco ) || empty($config_cep)){
            //die("sasas");
            $this->addError("O endereço de entrega não foi informado corretamente! Certifique-se que seu endereço de entrega está correto.");
        }

        /**
         * Verifica o estoque disponível de cada item.
         */
        if (!$this->verificaEstoque())
            return $this->setConfig("commit_ok", false);

        /**
         * Se houverem erros, retorna 'false'. Caso contrário, 'true'.
         */
        
        if(count($this->getErrors(false)) > 0){
            
            die(print_r($this->aErrors)); 
        }
        
        return $this->setConfig("commit_ok", (0 == count($this->getErrors(false))));
    }

    //---------------------------------------------------------------------------

    function getItem($iCodtamcor) {
        return $this->aItens[$iCodtamcor];
    }

    function getItens() {
        return $this->aItens;
    }

    function getQtdItens() {
        return count($this->aItens);
    }

    function isEmpty() {
        return 0 == $this->getQtdItens();
    }

    function hasItem($iCodtamcor) {
        return array_key_exists($iCodtamcor, $this->aItens);
    }

    function clearItens() {
        $this->aItens = array();
    }

    function hasItemByCodproduto($iCodproduto) {
        $aItens = $this->getItens();

        foreach ($aItens as $aItem)
            if ($iCodproduto == $aItem['codproduto'])
                return true;

        return false;
    }

    function getPeso() {

        $aItens = $this->getItens();
        $fPeso = 0;
        $aTamcor = array();

        foreach ($aItens as $iCodtamcor => $aInfo) {
            
            if(TEM_FRETEGRATIS === true){
                
                $addSql = "and fretegratis='N'";
            }

            if (TEM_FAIXA_FRETE === true || getSessionVar("calculaTransportadora")) {

                $sql = "select peso from produtos_precos where codtamcor='$iCodtamcor' $addSql";
                $rs = mysql_fetch_object(mysql_query($sql));
                $fPeso += $rs->peso;
            } else {
                
                if (!is_array($aInfo['composicao'])) {
                    
                    $codproduto = $aInfo['codproduto'];
                    $sql_prod = "select comprimento, altura, largura, peso from produtos_precos where codtamcor = '$iCodtamcor' $addSql";
                    $rs_prod = mysql_fetch_object(mysql_query($sql_prod));
                    
					if(sDatabase == "db_cremonesi")
						$fPeso += $this->calculaPesoRegraCorreios($rs_prod->peso, $rs_prod->comprimento, $rs_prod->altura, $rs_prod->largura) * $aInfo['qtd'];
					else
						$fPeso += max( ($rs_prod->comprimento * $rs_prod->altura * $rs_prod->largura)/6000 , $rs_prod->peso) * $aInfo['qtd'];
                    
                }else {
                    
                    $aComposicao = $aInfo['composicao'];
                    for ($i=0;$i < count($aComposicao);$i++){
                        
                        $iCodtamcor = $aComposicao[$i];
                        $sql_prod = "select comprimento, altura, largura, peso from produtos_precos where codtamcor = '$iCodtamcor' $addSql";
                        $rs_prod = mysql_fetch_object(mysql_query($sql_prod));
                        
						if(sDatabase == "db_cremonesi")
							$fPeso += $this->calculaPesoRegraCorreios($rs_prod->peso, $rs_prod->comprimento, $rs_prod->altura, $rs_prod->largura) * $aInfo['qtd'];
						else
							$fPeso += max( ($rs_prod->comprimento * $rs_prod->altura * $rs_prod->largura)/6000 , $rs_prod->peso) * $aInfo['qtd'];
					}     
                }
            }
            $aTamcor[] = $iCodtamcor;
        }
        
        if(TEM_FRETEGRATIS === true && count($aTamcor)>0 ){
            
            if(count($aTamcor) > 1){
                $addSql = "codtamcor in(".implode(",",$aTamcor).")";
            }else{
                $addSql = "codtamcor='".$aTamcor[0]."'";
            }
            
            $sql = "select count(*) as tt from produtos_precos where $addSql and fretegratis='N'";
            $rs = mysql_fetch_object(mysql_query($sql));
            
            if($rs->tt == 0){
                setSessionVar("freteGratis",true);
            }else{
                
                if(TEM_FAIXA_CEP === true){
                    
                    if($this->verificaFaixaCep()){
                        setSessionVar("freteGratis",true);
                    }else{
                        setSessionVar("freteGratis",false);
                    }
                }else{
                    setSessionVar("freteGratis",false);
                }
            }
        }
        
        return $fPeso;
    }

    //---------------------------------------------------------------------------

    function add($iCodtamcor, $iQtd=1, $aComposicao=false) {
		
		$this->setConfig("cep", null);
		$this->setConfig("valor_entrega", null);

		$oProduto = Produtos::getByCodtamcor($iCodtamcor);

        $valor = $oProduto->vlvenda;
        if (is_array($aComposicao)) {
            $valor = Produtos::getValorRack($aComposicao);
        }

        $this->aItens[$iCodtamcor] = array(
            "codproduto" => $oProduto->codproduto,
            "descricao" => Produtos::getDescricaoByCodtamcor($iCodtamcor),
            "valor" => $valor,
            "qtd" => $iQtd,
            "composicao" => $aComposicao
        );
        return $this->getItem($iCodtamcor);
    }

    function rem($iCodtamcor) {
		
		$this->setConfig("cep", null);
		$this->setConfig("valor_entrega", null);
		$this->setConfig("desccupom", 0);
		
		$aItem = $this->getItem($iCodtamcor);
        unset($this->aItens[$iCodtamcor]);
        return $aItem;
    }

    //---------------------------------------------------------------------------


    function ativaCupom() {
        $codcupom = $this->getConfig("codcupom");
        $ttCompra = $this->getTotalFinal();

        if ($codcupom == "") {
            return true;
        }
        $sql = "SELECT zValorCupomRestante('$codcupom','" . getSessionVar("codcliente") . "') as vlexcedente";
        $rsValor = mysql_fetch_object(mysql_query($sql));
        $sql = "select vlminimo, vldesconto, tipo from cupons_desconto where codcupom = '$codcupom'";
        $rs = mysql_fetch_object(mysql_query($sql));

        if ($rsValor->vlexcedente > 0) {
            $rs->vldesconto = $rs->vldesconto - $rsValor->vlexcedente;
        }
        if ($rs->vlminimo <= $ttCompra) {
            if ($rs->tipo == "VALOR") {
                if ($this->getTotalsemDesconto() < $rs->vldesconto) {
                    $vldesconto = $this->getTotalsemDesconto();
                    $this->setConfig("desc_excedente", $rs->vldesconto - $this->getTotalsemDesconto());
                } else {
                    $vldesconto = $rs->vldesconto;
                    $this->setConfig("desc_excedente", 0.00);
                }
                $this->setConfig('desccupom', $vldesconto);
            } else {
                $vldesconto = ($rs->vldesconto / 100) * $this->getTotalsemDesconto();
                $this->setConfig('desccupom', $vldesconto);
                $this->setConfig("desc_excedente", 0.00);
            }
        } else {
            $this->setConfig('desccupom', 0);
            return false;
        }
        return true;
    }

    function calculaDiferenca($iCodformapagto) {
        $bSimulacao = $this->isSimulacao();
        $fDiferenca = 0;

        if (0 == $iCodformapagto && !$bSimulacao)
            return $this->setConfig("valor_diferenca", $fDiferenca);

        $oFormaPagto = Monetario::getFormaPagto($iCodformapagto);
        $codcupom = $this->getConfig("codcupom");
        if ($codcupom > 0) {
            $sql = "select tipo from cupons_desconto where codcupom = '$codcupom'";
            $oResCupom = mysql_fetch_object(mysql_query($sql));
        }
        if ($oResCupom->tipo == "PERCENTUAL") {
            $fSubtotal = $this->getTotalProdutos();
        } else {
            $fSubtotal = $this->getTotalProdutos();
        }
        if (0 < $oFormaPagto->pcdesconto) {
            $fDiferenca = ($fSubtotal * (float) $oFormaPagto->pcdesconto) / 100;

            if (0 < $fDiferenca)
                $fDiferenca = $fDiferenca * -1;
        }
        else if (0 < $oFormaPagto->pcacrescimo) {
            $fDiferenca = ($fSubtotal * (float) $oFormaPagto->pcacrescimo) / 100;
        }
        return (!$bSimulacao) ? $this->setConfig("valor_diferenca", $fDiferenca) : $fDiferenca;
    }

    function calculaFrete($sCep) {
        

        /* CALCULO DO FRETE EM scripts.php */
        $peso = ($this->getPeso() < 1? 1 : $this->getPeso());
        $aFrete = calculaFrete($sCep, $this->getTotalProdutos(), $peso, $this->getTipoEntrega());
        $fValorEntrega = $aFrete['frete'];
        $iPrazoEntrega = $aFrete['prazo_entrega'];
		$this->setConfig("erro_descricao",$aFrete['erro_descricao']);
        
         
        // RETIRA LOJA
        if($this->getConfig("tipo_entrega") == 3){
			
			if($this->isCrossDocking($this->getItens(), "TODOS"))
			{
				$this->setConfig("prazo_entrega", $this->getTempoCrossDocking()." dias úteis");
			}
			else
			{
				$this->setConfig("prazo_entrega", "Imediato");
			}
            return $this->setConfig("valor_entrega", "0");
		}
        
        
        /* MENSAGEM DE ERRO */
        if(!empty($aFrete['erro_descricao'])){
            return $this->setErroCalculoFrete($aFrete["erro_descricao"]); 
        }
        
        
        /* SE ALGUM PRODUTO É CROSSDOCKING, ACRESCENTA DOIS DIAS NO PRAZO DE ENTREGA */
        if($this->isCrossDocking($this->getItens(), "TODOS") && TEM_FAIXA_FRETE === false && !getSessionVar("calculaTransportadora")){
            $iPrazoEntrega += $this->getTempoCrossDocking();
        }
		
		
		$this->setConfig("prazo_entrega", "Prazo de Entrega: ".$iPrazoEntrega . ( !getSessionVar("calculaTransportadora") ? ($iPrazoEntrega == 1 ? " dia útil": " dias úteis") : ""));
        
        
        /* IMPOSTO ICMS SOBRE COMPRA - DE ACORDO COM O ESTADO */
        if(TEM_IMPOSTO === true){
            
            $aInfoImposto = $this->getImpostoPorEstado($sCep);
            $this->setConfig("imposto_estado",$aInfoImposto);    
        }
		
		
		//----------------------------------------------------------------------
		// TEM FRETE PRÓPRIO
		//----------------------------------------------------------------------
		
		if($this->getConfig("tipo_entrega") == 8 && TEM_FRETE_PROPRIO === true){
			
			global $aFretesEntregaRapida;
			$bCalculou = false;
			foreach($aFretesEntregaRapida as $sCidade => $sCeps){
				
				$aFaixas = explode("|",$sCeps);
				
				if($sCep >= $aFaixas[0] && $sCep <= $aFaixas[1]){
					$this->setConfig("prazo_entrega", "Prazo de Entrega: 4 Horas para $sCidade!"); 
					$fValorEntrega = $aFaixas[2];
					$bCalculou = true;
				}
			}
			
			if(!$bCalculou){
				return $this->setErroCalculoFrete("Tipo de Entrega não disponível para sua região.");
			}
		}
        
        
        if(getSessionVar("freteGratis")){
            $fValorEntrega = 0;
        }

        return $this->setConfig("valor_entrega", $fValorEntrega);
    }

    function calculaParcela($iCodformapagto) {
        $bSimulacao = $this->isSimulacao();
        $oFormaPagto = Monetario::getFormaPagto($iCodformapagto);

        if (1 >= $oFormaPagto->numparcelas && !$bSimulacao)
            return $this->setConfig("valor_parcela", 0.00);
		
		//$fTotalFinal = $this->getSubTotal(); // alterado em 27/12/2012 - para resolver totais no e-mail inserida linha abaixo
        $fTotalFinal = $this->getTotalFinal();

		if ($oFormaPagto->numparcelas == 0) {
            $oFormaPagto->numparcelas = 1;
        }
        $fParcela = (float) number_format(($fTotalFinal / $oFormaPagto->numparcelas), 2);

        return (!$bSimulacao) ? $this->setConfig("valor_parcela", $fParcela) : $fParcela;
    }

    function simulaValorPagamento($iCodformapagto) {
        $bSimulacaoAtual = $this->getConfig("modo_simulacao");
        $this->setConfig("modo_simulacao", true);

        $fDiferenca = $this->calculaDiferenca($iCodformapagto);
        $fTotal = $this->getTotalCompra() + $fDiferenca;
        $fParcela = $this->calculaParcela($iCodformapagto);

        $this->setConfig("modo_simulacao", $bSimulacaoAtual);

        return array(
            "total" => $fTotal,
            "parcela" => $fParcela,
            "diferenca" => $fDiferenca
        );
    }

    function getTipoEntrega() {
        $aTiposEntrega = array(
            self::TIPO_ENTREGA_SEDEX => "SEDEX",
            self::TIPO_ENTREGA_PAC => "PAC",
            self::TIPO_ENTREGA_RETIRALOJA => "RETIRA-LOJA",
            self::TIPO_ENTREGA_GRATIS => "FRETE-GRATIS",
            self::TIPO_ENTREGA_TRANSPORTADORA => "TRANSPORTADORA",
			self::TIPO_ENTREGA_E_SEDEX => "e-SEDEX",
			self::TIPO_ENTREGA_SEDEX_10 => "SEDEX-10",
			self::TIPO_ENTREGA_PROPRIO => "ENTREGA RÁPIDA",
		);
        return $aTiposEntrega[$this->getConfig("tipo_entrega")];
    }

    //---------------------------------------------------------------------------

    function getSubTotal() {
        $iTotal = 0;

        foreach ($this->aItens as $iCodtamcor => $aInfo)
            $iTotal += $aInfo['valor'] * $aInfo['qtd'];
        
        return $iTotal - $this->getConfig('desccupom') + $this->getConfig("valor_entrega");
    }

    function getTotalsemDesconto() {
        $iTotal = 0;

        foreach ($this->aItens as $iCodtamcor => $aInfo)
            $iTotal += $aInfo['valor'] * $aInfo['qtd'];

        return $iTotal + $this->getConfig("valor_entrega") + $this->getConfig("valor_diferenca");
    }

    function getTotalcomDesconto() {
        $iTotal = 0;

        foreach ($this->aItens as $iCodtamcor => $aInfo)
            $iTotal += $aInfo['valor'] * $aInfo['qtd'];
        return $iTotal - ($this->getConfig('desccupom') > $this->getTotalProdutos() ? $this->getTotalProdutos() : $this->getConfig('desccupom'));
    }

    function getTotalProdutos() {
        $iTotal = 0;

        foreach ($this->aItens as $iCodtamcor => $aInfo)
            $iTotal += $aInfo['valor'] * $aInfo['qtd'];

        return $iTotal;
    }

    function getDescontos() {
        return $this->getConfig('desccupom');
    }

    function getTotalCompra() {
        
        if(TEM_IMPOSTO === true){
            $aImpostoinfo = $this->getConfig("imposto_estado");
            $vlImposto = $aImpostoinfo["taxa"]*$this->getTotalProdutos();
            $this->setConfig("vlimposto",$vlImposto);
            return $vlImposto+$this->getSubTotal(); 
        }
        
        return $this->getSubTotal() + $this->getConfig("vl_presente");
    }

    function getTotalLiquido() {
        return $this->getTotalCompra() + $this->getConfig("valor_diferenca");
    }

    function getTotalFinal() {
        return $this->getTotalLiquido();
    }

    function getInfoCartao4Boleto() {
        $aCartao = $this->getConfig("info_cartao");

        return _array_serialize(array(
            "Bandeira" => $aCartao['f_cartao_bandeira'],
            "Numero" => $aCartao['f_cartao_numero'],
            "Nome" => $aCartao['f_cartao_titular'],
            "Validade" => $aCartao['f_cartao_validade'],
            "Codigo" => $aCartao['f_cartao_codverificacao']
        ));
    }

    //---------------------------------------------------------------------------

    function unsetErrors() {
        $this->aErrors = array();
    }

    function addError($sError) {
        array_push($this->aErrors, $sError);
        return $this->aErrors;
    }

    function getErrors($bUnset=true, $bHtmlFormat=false) {
        $aErrors = $this->aErrors;

        if ($bUnset)
            $this->unsetErrors();

        if (!$bHtmlFormat)
            return $aErrors;

        $sHtml .= '<ul>';
        $sHtml .= '<li>' . implode('</li><li>', $aErrors) . '</li>';
        $sHtml .= '</ul>';

        return $sHtml;
    }

    //===========================================================================
    //====================== MÉTODOS P/ FECHAR A COMPRA =========================
    //===========================================================================

    function commit($bReset=false) {
        
        /**
         * Executa a validação antes de confirmar a compra.
         */
        $this->validate4Commit();
        if (!$this->ready4Commit())
            return false;
        
        
        /**
         * Algumas configurações iniciais.
         */
        $iCodloja = getConfig("LOJASITE");
        $iCodvendedor = getConfig("VENDEDORSITE");
        $iCodformapagto = $this->getConfig("codformapagto");
        $iCodcliente = getSessionVar("codcliente");



        $oFormaPagto = Monetario::getFormaPagto($iCodformapagto);
        $now = "now()";

        
        if ($oFormaPagto->especie == "CARTAO" && verificaIntegracao("PGDIGITAL")) {
            
            $iCodformapagto = getConfig("FORMAPGDIGITAL");
            $sql = "select * from formapagamento where codforma = '$iCodformapagto'";
            $oFormaPagto = mysql_fetch_object(mysql_query($sql));

            $now = "date_add(now(), interval " . ($oFormaPagto->parcela1 * 1) . " day)";
        }
		
		$sIp = $_SERVER["REMOTE_ADDR"];

        $vlDesconto = $this->getDescontos();
        $vlImposto  = $this->getConfig("vlimposto");

        /**
         * Registra a compra.
         */
        
        if(TEM_FAIXA_FRETE === true || getSessionVar("calculaTransportadora")){
            $sTpfrete = (getSessionVar("freteGratis")?"FRETE-GRATIS":getTransportadoraByCodtabela(getSessionVar("codtabela")));
        }else{
            $sTpfrete = (getSessionVar("freteGratis")?"FRETE-GRATIS":$this->getTipoEntrega());
        }
        
        $sSql = "insert into vendas set 
					 codloja='{$iCodloja}', codvendedor='{$iCodvendedor}', codforma='{$iCodformapagto}', codcliente='{$iCodcliente}', canal='LOJA VIRTUAL',
					 formapagto='{$oFormaPagto->descricao}', pcforma='{$oFormaPagto->pcdesconto}',cpdesconto = '" . $this->getConfig('codcupom') . "', pcformaac='{$oFormaPagto->pcacrescimo}',
					 vldesconto='{$vlDesconto}', dtvenda=now(), status_venda='" . sStatusVendaPadrao . "',
					 tpfrete= '$sTpfrete', vlfrete='" . $this->getConfig("valor_entrega") . "', vlimposto='$vlImposto',  dtcadastro=now(), ativo='S', internet='S', ip='{$sIp}'";
        $oDbq = mysql_query($sSql) or die($sSql . "<hr>" . mysql_error());

        /**
         * Grava o código da compra recém-gravada.
         */
        $iCodvenda = mysql_insert_id();
        
        
        /* Se houve desconto por cupom, insere o cupom na tabela vendas_cupons */
        if ($this->getConfig('desccupom') > 0) {
            $sql = "SELECT zValorCupomRestante('$codcupom','" . getSessionVar("codcliente") . "') as vlexcedente ";
            $rs = mysql_fetch_object(mysql_query($sql));
            if ($rs->vlexcedente === null) {
                $sql = "insert into vendas_cupons set codcupom = '" . $this->getConfig('codcupom') . "', codvenda = '$iCodvenda', vldesconto = '" . number_format($this->getConfig('desccupom'), 2, ".", "") . "'";
            } else {
                $sql = "update vendas_cupons set codvenda = '$iCodvenda' where codcupom = '" . $this->getConfig('codcupom') . "'";
            }
            mysql_query($sql);
        }


        /**
         * Grava os itens da compra.
         */
        $aItens = $this->getItens();

        foreach ($aItens as $iCodtamcor => $aInfo) {
            
            $oProduto = Produtos::get($iCodtamcor);

                $sSql = "insert into vendas_itens set
                             codvenda='{$iCodvenda}', codtamcor='{$iCodtamcor}', codproduto='{$aInfo['codproduto']}',
                             qtd='{$aInfo['qtd']}', valor='{$aInfo['valor']}', vlcusto='{$oProduto->vlcusto}',
                             brinde='N', atendido='N', dtcadastro=now()";
                $oDbq = mysql_query($sSql) or die($sSql . "<hr>" . mysql_error());
                
                
                /*ainda é preciso averiguar se as composições devem mesmo ser vendidas com valor zero.*/
                if (is_array($aInfo['composicao'])){
                    $aComposicao = $aInfo['composicao'];
                    for($k=0; $k < count($aComposicao);$k++){
                        $iCodtamcor = $aComposicao[$k];
                        $oCompo = Produtos::get($iCodtamcor);
                        $sSql = "insert into vendas_itens set
                                     codvenda='{$iCodvenda}', codtamcor='{$iCodtamcor}', codproduto='$oCompo->codproduto',
                                     qtd=1, valor='0.00', vlcusto={$oCompo->vlcusto},
                                     brinde='N', atendido='N', dtcadastro=now()";
                        mysql_query($sSql);
                    }
                }
        }


        $sql = "insert into vendas_condicoes set
                    codvenda         = '$iCodvenda',
                    chksum           = '',
                    indice           = '0',
                    dtvencimento     = $now,
                    valor            = '" . $this->getTotalFinal() . "',
                    especie          = '$oFormaPagto->especie',
                    editado          = 'I',
                    bandeira         = '$oFormaPagto->bandeira',
                    qtd              = '$oFormaPagto->numparcelas',
                    vldespesa        = '0',
                    txtdoc           = '',
                    codforma         = '$oFormaPagto->codforma',
                    forma            = '$oFormaPagto->descricao',
                    dtcadastro       = now()";
        mysql_query($sql) or die($sql);
        $iCodcondicao = mysql_insert_id();
        
        $aDadosPresente = getSessionVar("aDadosPresente");
            
		if(count($aDadosPresente) > 0){

			$sql = "insert into vendas_presente set
					codvenda = '$iCodvenda',
					de =       '".$aDadosPresente["de"]."',
					para =     '".$aDadosPresente["para"]."',
					mensagem = '".$aDadosPresente["mensagem"]."', 
					custo =    '".valorPresente."'";
			mysql_query($sql) or die($sql); 
		}
		
        /*
         * Registra o boleto desta compra, independente da forma de pagto. Desta
         * forma, se o cliente necessitar do boleto, é possível gerá-lo.
         */
        $this->registrarBoleto($iCodvenda, $iCodcondicao);


        if(bTrabalharComEstoque){
            
            if($this->isCrossDocking($iCodvenda, "VENDA")){
                VendasEstoque::baixarPorEncomenda($iCodvenda, $iCodloja);
            }else{
                VendasEstoque::baixar($iCodvenda, $iCodloja);
            }
        }
        
        /**
         * Grava a compra como uma compra feita pelo site.
         */
        
        if(TEM_ONEPAGE_CHECKOUT === true){
            $addSql = ", pesquisa='".getSessionVar("pesquisa")."'";
        }
        
        $sSql = "insert into vendas_site set tpfrete  = '" . $this->getTipoEntrega() . "', codvenda='{$iCodvenda}', status_venda='" . sStatusVendaSitePadrao . "', vlfrete='" . $this->getConfig("valor_entrega") . "', codendvenda='".$this->getConfig("codendereco")."' $addSql";
        $oDbq = mysql_query($sSql) or die($sSql . "<hr>" . mysql_error());

        /**
         * Reseta as configurações do carrinho.
         */
        if ($bReset){
            $this->_reset();
        }    
        
        return $iCodvenda;
    }

    function registrarBoleto($iCodvenda, $iCodcondicao=0) {
        if (empty($iCodvenda) || 0 == $iCodvenda)
            return false;

        /**
         * Configurações inicias.
         */
        $aDadosBoleto = _to_array(aDadosBoleto);
        $iCodpessoa = getSessionVar("codpessoa");
        $oEndereco = Pessoas::getEndereco($iCodpessoa, "COR");
        $sId = uniqueString();

        /**
         * Gera a data de vencimento.
         */
        $sTsDtVencimento = mktime(0, 0, 0, date("m"), date("d") + $aDadosBoleto['dias_vencimento'], date("Y"));
        $sDiaSemana = date("w", $sTsDtVencimento);

        if (0 == $sDiaSemana) //domingo
            $sTsDtVencimento = mktime(0, 0, 0, date("m"), date("d") + $aDadosBoleto['dias_vencimento'] + 1, date("Y"));
        else if (6 == $sDiaSemana) //sábado
            $sTsDtVencimento = mktime(0, 0, 0, date("m"), date("d") + $aDadosBoleto['dias_vencimento'] + 2, date("Y"));

        $sDtHoje = date("Y-m-d");
        $sDtVencimento = date("Y-m-d", $sTsDtVencimento);

        /**
         * Campos da tabela 'vendas_boleto'.
         */
        $aFields = array(
            "codvenda", "vdoc", "vcto", "ddoc", "dproc", "cart", "cdte", "sacado",
            "cpf", "endereco", "bairro", "cep", "estado", "demons1", "demons2",
            "demons3", "demons4", "agcod", "instr1", "instr2", "instr3", "instr4",
            "tipo", "boletomail", "email", "banco", "id", "email_cliente",
            "formapagamento", "infocartao", "cidade", 'codcondicao'
        );

        $sql = "select * from contas where codforma='" . $this->getConfig("codformapagto") . "' ";
        $stmt = mysql_query($sql);
        $num = mysql_num_rows($stmt);
        if ($num > 0) {
            $rsContas = mysql_fetch_object(mysql_query($sql));
        } else {
            /* SE A FORMA DE PAGAMENTO NÃO FOR BOLETO, ELE GERA O BOLETO PELO CONFIG(FORMABOLETO)*/
            $sql = "select * from contas where codforma = '".getConfig("FORMABOLETO")."'";
            $rsContas = mysql_fetch_object(mysql_query($sql));
        }
        
        if(TEM_ONEPAGE_CHECKOUT === true && !getSessionVar("permite")){
            
            $aDadosCheckout = getSessionVar("aDadosCheckout");
            
            $sNome  = $aDadosCheckout["nome"];
            $sCpf   = $aDadosCheckout["cpf"];
            $sEmail = $aDadosCheckout["email"];
        }else{
            
            $sNome  = getSessionVar("nome");
            $sCpf   = Pessoas::get($iCodpessoa, "cpf");
            $sEmail = getSessionVar("email");
        }


        /**
         * Geração do array de dados que será utilizado para geração da SQL.
         */
        $aDados = array(
            $iCodvenda, $this->getTotalFinal(), $sDtVencimento, $sDtHoje, $sDtHoje, $rsContas->carteira, sSiteNome, $sNome,
            $sCpf, "$oEndereco->endereco, $oEndereco->numero", $oEndereco->bairro, $oEndereco->cep, $oEndereco->estado, $rsContas->demons1, $rsContas->demons2,
            $rsContas->demons3, $rsContas->demons4, $rsContas->agencia . "/" . $rsContas->num_conta, $rsContas->instr1, $rsContas->instr2, $rsContas->instr3, $rsContas->instr4,
            "html", "0", sEmailContato, $rsContas->banco, $sId, $sEmail, $this->getConfig("codformapagto"), $this->getInfoCartao4Boleto(), $oEndereco->cidade, "$iCodcondicao"
        );
        $aDados = _array_associate($aFields, $aDados);


        /*
         * Registra as informações.
         */
        
        $sSql = "insert into vendas_boletos set " . getSql($aFields, $aDados, "");
        $oDbq = mysql_query($sSql) or die($sSql);

        $sql = "select nnum from vendas_boletos where codvenda = '$iCodvenda'";
        $rsNum = mysql_fetch_object(mysql_query($sql));
        $nnum = $rsNum->nnum * 1;

        $sql = "update vendas_boletos set infocartao = '" . encryptHTTP(md5("$nnum#$sDtHoje#" . sDatabase), $this->getInfoCartao4Boleto()) . "' where nnum = '$nnum' ";
        mysql_query($sql);


        return $nnum;
    }
    
    function isCrossDocking($iCod, $sTipo){
        
        switch($sTipo){
        
            case "VENDA":
            
                $sql = "select codtamcor from produtos_precos where codtamcor in(select codtamcor from vendas_itens where codvenda='$iCod') and internet='CD' ";
                $stmt = mysql_query($sql);
                $num = mysql_num_rows($stmt);
                
                if( $num > 0 ){
                
                    while($rs = mysql_fetch_object($stmt)){
                    
                        if(Produtos::getQtdEstoque($rs->codtamcor) == 0){
                            
                            return true;
                        }
                    }
                }
                return false;
            
            case "ITEM":
            
                $sql = "select internet from produtos_precos where codtamcor='$iCod'";
                $rs = mysql_fetch_object(mysql_query($sql));
                return ($rs->internet == "CD" ? true : false );
                
            case "TODOS":
                
                foreach($iCod as $iCodtamcor => $aInfo){
                
                    $sql = "select internet from produtos_precos where codtamcor='$iCodtamcor'";
                    $rs = mysql_fetch_object(mysql_query($sql));
                    if($rs->internet == "CD"){
                        return true;
                    }
                }
                return false;
        }
    }

    function verificaEstoque() {
        
        $aItens = $this->getItens();
        $aProdutos = array();

        foreach ($aItens as $iCodtamcor => $aInfo)
            if (Produtos::getQtdEstoque($iCodtamcor) < $aInfo['qtd'] && !$this->isCrossDocking($iCodtamcor, "ITEM"))
                $aProdutos[] = Produtos::getDescricaoByCodtamcor($iCodtamcor);


        if (0 == count($aProdutos)) {
            return true;
        } else {
            $this->addError("Durante sua compra, os seguintes itens foram vendidos, logo, a quantidade solicitada não está mais disponível: " . implode(", ", $aProdutos));
            return false;
        }
    }

    //---------------------------------------------------------------------------

    function _reset() {
        $this->aConfig = array(
            "verificado" => false,
            "commit_ok" => false,
            "codpessoa" => 0,
            "codcliente" => 0,
            "codformapagto" => 0,
            "codendereco" => 0,
            "codcupom" => "",
            "cep" => "",
            "prazo_entrega" => "",
            "tipo_entrega" => self::TIPO_ENTREGA_SEDEX,
            "valor_diferenca" => 0.00,
            "valor_entrega" => 0.00,
            "valor_parcela" => 0.00,
            "desccupom" => 0.00,
            "desc_excedente" => 0.00,
            "info_cartao" => array(),
            "modo_simulacao" => false,
            "imposto_estado" => 0.00,
            "vlimposto" => 0.00,
            "vl_presente" => 0.00,
        );
        
        setSessionVar("freteGratis",false);
        
        if(TEM_FAIXA_FRETE === true || getSessionVar("calculaTransportadora")){
            
            setSessionVar("codtabela",null);
        }

        if(TEM_ONEPAGE_CHECKOUT === true){
        
            setSessionVar("aDadosCheckout",null);
            setSessionVar("aDadosPresente",null);
            setSessionVar("pesquisa",null);
        }
        
        $this->clearItens();
        $this->unsetErrors();
		updateCookie();
    }
    
    function getImpostoPorEstado($sCep){
        
        if (empty($sCep)){
            return array();
        }
        
        /* VERIFICA O ESTADO DE ACORDO COM O CEP */
        $sql = "SELECT ibge.uf FROM frete_estados fe INNER JOIN ibge_municipios ibge ON fe.uf=ibge.sigla
                WHERE ('$sCep' >= cep_cap_ini  && '$sCep' <= cep_cap_fim) OR ('$sCep' >= cep_cap_ini2  && '$sCep' <= cep_cap_fim2)
                OR ('$sCep' >= cep_ini  && '$sCep' <= cep_fim) OR ('$sCep' >= cep_ini2  && '$sCep' <= cep_fim2)
                GROUP BY fe.uf";
		$rs = mysql_fetch_object(mysql_query($sql));
       
        $sql = "SELECT imposto FROM produtos_impostos WHERE uf='$rs->uf'";
        $rsImposto = mysql_fetch_object(mysql_query($sql));

        return array("taxa" => ($rsImposto->imposto/100), "estado"=>$rs->uf);
    }
    
    function verificaFaixaCep($sCep="", $iCodtamcor=0, $iTipoEntrega=0){
        
        if(empty($sCep)){
            $sCep = $this->getConfig("cep");
        }
        
        $hoje = date("Y-m-d");
        
        $sql = "SELECT * FROM faixas_cep WHERE '$sCep'>=cep_ini AND '$sCep'<=cep_fim AND ativo='S' AND  
                IF(dtinicio != '0000-00-00', dtinicio <= '$hoje','1=1') AND 
                IF(dtfinal != '0000-00-00', dtfinal >= '$hoje','1=1')";
        
        //$sql = "SELECT apartir FROM faixas_cep WHERE '$sCep'>=cep_ini AND '$sCep'<=cep_fim and ativo='S'";
        $stmt = mysql_query($sql) or die($sql);
		$rs = mysql_fetch_object($stmt);
        
        if($iCodtamcor != 0){
            
            $sql = "SELECT IF(vlpromocao != 0, vlpromocao, vlvenda) AS valor FROM vw_produtos_site WHERE codtamcor='$iCodtamcor'";
            $rsValor = mysql_fetch_object(mysql_query($sql));
            $fTotalProdutos = $rsValor->valor;
            
        }else{
            
            $fTotalProdutos = $this->getTotalProdutos();
        }
        
        if(getSessionVar("calculaTransportadora")){
            
            $addSql = "and tipo='TRANSPORTADORA'";
            $iComparador = getSessionVar("codtabela");
        }else{
            
            $addSql = "and tipo='CORREIOS'";
            $iComparador = ($iTipoEntrega == 0 ? $this->getConfig("tipo_entrega") : $iTipoEntrega);
        }
        
        $sql = "select count(*) as tt from faixas_cep_tipo where codfaixa='$rs->codfaixa' and codtipo='$iComparador' $addSql";
        $rsVer = mysql_fetch_object(mysql_query($sql));
		
		if(mysql_num_rows($stmt) > 0 && $fTotalProdutos >= $rs->apartir && $rsVer->tt > 0){
            $this->setConfig("codfaixa",$rs->codfaixa);
            return true;
        }
		
        return false;
    }
	
	function verificaFaixaCepTransportadora($sCepDestino, $sPeso, $iCodtabela){
		
		$sRelecionamento = "SELECT taxa_interior, taxa_capital, prazo_entrega FROM frete_estados fe 
                        INNER JOIN frete_faixas_estados ffe ON fe.codestado=ffe.codestado 
                        INNER JOIN frete_faixas ff ON ffe.codfaixa=ff.codfaixa
                        INNER JOIN frete_pesos fp ON ff.codtabela=fp.codtabela
                        INNER JOIN frete_taxas ft ON ffe.codfaixa=ft.codfaixa AND fp.codpeso=ft.codpeso";

		// VERIFICA SE É CAPITAL
		$sql = "$sRelecionamento WHERE (('$sCepDestino' >= cep_cap_ini  && '$sCepDestino' <= cep_cap_fim) OR ('$sCepDestino' >= cep_cap_ini2  && '$sCepDestino' <= cep_cap_fim2)) AND ('$sPeso' >= peso_ini && '$sPeso' <= peso_fim) and ff.codtabela='$iCodtabela'";
		$num = mysql_num_rows(mysql_query($sql));

		// VERIFICA POR UF
		if ($num == 0) {

			$sql = "$sRelecionamento WHERE (('$sCepDestino' >= cep_ini  && '$sCepDestino' <= cep_fim) OR ('$sCepDestino' >= cep_ini2  && '$sCepDestino' <= cep_fim2)) AND ('$sPeso' >= peso_ini && '$sPeso' <= peso_fim) and ff.codtabela='$iCodtabela'";
			$num = mysql_num_rows(mysql_query($sql));
		}
		
		if ($num > 0) {
			return true;
		}
		
		return false;
	}
	
	function setErroCalculoFrete($sErroDescricao){
		
		$this->setConfig("erro_descricao", "<span style='color:red'>$sErroDescricao</span>");
		$this->setConfig("valor_entrega", "ERRO");
		$this->setConfig("prazo_entrega", ""); 
	}
	
	
	// REGRA ATUALIZADA EM 14/01/2013 - RODOLFO
	function calculaPesoRegraCorreios($fPeso, $fComprimento, $fAltura, $fLargura){
		
		$iTipoEntrega = $this->getConfig("tipo_entrega");
		
		$fAreaEmbalagem = $fComprimento * $fAltura * $fLargura;
		$fPesoCubico = $fAreaEmbalagem / 6000;
		
		$fLimeteIsencaoCubagem = ($iTipoEntrega == 2 ? 5 : 10);
		
		if($fPesoCubico >= $fLimeteIsencaoCubagem){
			
			$fPesoCalculado = max($fPeso, $fPesoCubico);
		}else{
			
			$fPesoCalculado = $fPeso;
		}
		
		return $fPesoCalculado;
	}
	
	public function getTempoCrossDocking()
	{
		$aMarcas = array();
		foreach($this->aItens as $aInfo)
		{
			$iCodproduto = $aInfo["codproduto"];
			$sql = "select codmarca from produtos where codproduto='$iCodproduto'";
			$rs = mysql_fetch_object(mysql_query($sql));
			$aMarcas[] = $rs->codmarca;
		}
		
		$sql = "select max(crossdocking) as diasAdd from marcas where codmarca in('".implode("','",$aMarcas)."')";
		$rs = mysql_fetch_object(mysql_query($sql));
		
		return ($rs->diasAdd > 0 ? $rs->diasAdd : 2);
	}
}

?>