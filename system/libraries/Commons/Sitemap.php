<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* -------------------------------------------------------------------------------
* SiteMap
* 	Gerencia o mapa do site
* -------------------------------------------------------------------------------
* Criado em....: 19/12/2007
* Alterado em..: 19/03/2013
* -------------------------------------------------------------------------------
* Changelog
* 
* 16/01/2008
*	- Alterações nos seguintes métodos:
*		- 'getLastChild': agora, para retornar o último filho (com auxílio do
*		  método 'getNthChild'), o índice informado é ('getNextOrdem' - 1).
*		
*		- 'getNext': alteração no comportamento do método, para evitar erros
*		  quando o índice não estiver sequencialmente ordenado.
*		
*		- 'getPrevious': idem ao anterior.
*
* 29/02/2008
*	- O método 'setString4Sql' agora utiliza 'mysql_real_escape_string' (antes
*	  ele utilizava o 'addslashes').
* 
* 29/04/2008
*	- O método 'getNextOrdem' agora necessita de um segundo parâmetro que informe
*	  a área sempre que o primeiro parâmetro (codpai) for 0.
*	- O método 'getLink' foi atualizado. O primeiro parâmetro agora pode ser um
*	  array. A primeira posição é a URL (com ou sem query string) e a segunda
*	  pode ser um array para integrar a query string.
* -------------------------------------------------------------------------------
*/

class Sitemap extends CI_Model 
{	
    function __construct() 
    {
        parent::__construct();
        log_message('Sitemap inicializada');
    }
    
    
    function get($iCodsecao)
    {
        if(empty($iCodsecao))
            return;
	
        
        return $this->db
                ->where('codsecao',$iCodsecao)
                ->get('sitemap')
                ->result();        
        
        
        //$sSql = "select * from sitemap where codsecao={$iCodsecao}";
        //return mysql_fetch_assoc(mysql_query($sSql));
    }
	
    function getAll($sArea, $sOrderBy="descricao asc")
    {
        if(empty($sArea))
            return array();		
        //$aSitemap = array();		
        
        return $this->db
                ->where('ativo','S')
                ->where('area',$sArea)
                ->order_by($sOrderBy)
                ->get('sitemap')
                ->result();
        
        
        //$sSql = "select * from sitemap where ativo='S' and area='{$sArea}' order by {$sOrderBy}";
        //$oDbq = mysql_query($sSql) or die(mysql_error());		
        //while($aRes = mysql_fetch_assoc($oDbq))
        //$aSitemap[] = $aRes;		
        //return $aSitemap;
    }
	
    function getAllCodsecao($sArea)
    {
        if(empty($sArea))
            return array();	
        
        //$aCodsecao = array();		
        
        return $this->db
                ->select('codsecao')
                ->where('ativo','S')
                ->where('area',$sArea)
                ->get('sitemap')
                ->result();        
        
        //$sSql = "select codsecao from sitemap where ativo='S' and area='{$sArea}'";
        //$oDbq = mysql_query($sSql) or die(mysql_error());		
        //while($oRes = mysql_fetch_object($oDbq))
        //   $aCodsecao[] = $oRes->codsecao;		
        
        //return $aCodsecao;
    }
	
	//---------------------------------------------------------------------------
    
    function getMain($sArea)
    {
        return $this->db
                ->where('ativo','S')
                ->where('codpai',0)
                ->where('area',$sArea)
                ->order_by('ordem','asc')
                ->get('sitemap')
                ->result();
        
        //$sSql = "select * from sitemap where ativo='S' and codpai=0 and area='{$sArea}' order by ordem asc";
        //$oDbq = mysql_query($sSql) or die(mysql_error());
		
        //$aSitemap = array();
		
        //while($aRes = mysql_fetch_assoc($oDbq))
        //    $aSitemap[] = $aRes;
		
        //return $aSitemap;
    }
	
    function getParent($iCodsecao)
    {
        $iCodpai = Sitemap::getProperty($iCodsecao, "codpai");
        return (0 < $iCodpai) ? Sitemap::get($iCodpai) : array("codsecao" => 0);
    }

    function getParentCnt($iCodconteudo)
    {
        $sql = "select codsecao from conteudos where codconteudo = '$iCodconteudo'";
        $rs = mysql_fetch_object(mysql_query($sql));
	return $rs->codsecao;
    }

	
    function getChildren($iCodpai, $sArea="")
    {
        if(0 == $iCodpai)
        {
            if(empty($sArea))
                Sitemap::throwError(__FUNCTION__, "Quando o primeiro parâmetro desta função for 0 (zero), é necessário informar a área!");
            return Sitemap::getMain($sArea);
	}
		
	$sSql = "select * from sitemap where ativo='S' and codpai={$iCodpai} order by ordem asc";
	$oDbq = mysql_query($sSql) or die(mysql_error());
		
	$aSitemap = array();
		
	while($aRes = mysql_fetch_assoc($oDbq))
            $aSitemap[] = $aRes;
		
	return $aSitemap;
    }
	
    function getQtdChildren($iCodpai, $sArea="")
    {
        if(0 == $iCodpai)
        {
            if(!empty($sArea))
                $sWhereAdd = " and area='{$sArea}'";
            else
                Sitemap::throwError(__FUNCTION__, "Quando o primeiro parâmetro desta função for 0 (zero), é necessário informar a área!");
        }
		
	$sSql = "select count(*) as total from sitemap where codpai={$iCodpai} {$sWhereAdd}";
	$oRes = mysql_fetch_object(mysql_query($sSql));
		
	return $oRes->total;
    }
	
    function getNthChild($iCodpai, $iOrdem, $sArea="")
    {
        if(0 == $iCodpai)
        {
            if(!empty($sArea))
                $sWhereAdd = " and area='{$sArea}'";
            else
                Sitemap::throwError(__FUNCTION__, "Quando o primeiro parâmetro desta função for 0 (zero), é necessário informar a área!");
        }
		
	if(empty($iOrdem))
            return false;
		
	$sSql = "select * from sitemap where ativo='S' and ordem={$iOrdem} and codpai={$iCodpai} {$sWhereAdd} limit 1";
	$oDbq = mysql_query($sSql) or die(mysql_error());
		
	return (0 < mysql_num_rows($oDbq)) ? mysql_fetch_assoc($oDbq) : array();
    }
	
    function getFirstChild($iCodpai, $sArea="")
    {
        return Sitemap::getNthChild($iCodpai, 1, $sArea);
    }
	
    function getLastChild($iCodpai, $sArea="")
    {
        return Sitemap::getNthChild($iCodpai, (Sitemap::getNextOrdem($iCodpai, $sArea)-1), $sArea);
    }
	
    function getNext($iCodsecao, $sArea="")
    {
        $iOrdem	 = Sitemap::getOrdem($iCodsecao);
	$aParent = Sitemap::getParent($iCodsecao);
		
	$sSql = "select min(ordem) as ordem from sitemap where ordem > {$iOrdem} and codpai={$aParent['codsecao']}";
	$oRes = mysql_fetch_object(mysql_query($sSql));
		
	return Sitemap::getNthChild($aParent['codsecao'], $oRes->ordem, $sArea);
    }
	
    function getPrevious($iCodsecao, $sArea="")
    {
        $iOrdem	 = Sitemap::getOrdem($iCodsecao);
	$aParent = Sitemap::getParent($iCodsecao);
		
	$sSql = "select max(ordem) as ordem from sitemap where ordem < {$iOrdem} and codpai={$aParent['codsecao']}";
	$oRes = mysql_fetch_object(mysql_query($sSql));
		
	return Sitemap::getNthChild($aParent['codsecao'], $oRes->ordem, $sArea);
    }
	
    function getSiblings($iCodsecao, $sArea="")
    {
        $aParent = Sitemap::getParent($iCodsecao);
        return Sitemap::getChildren($aParent['codsecao'], $sArea);
    }
	
	//---------------------------------------------------------------------------
    
    function isParent($iCodsecao, $sArea="")
    {
        return 0 < Sitemap::getQtdChildren($iCodsecao, $sArea);
    }
	
    function isChild($iCodsecao)
    {
        return 0 < Sitemap::getProperty($iCodsecao, "codpai");
    }
	
    function isFirstChild($iCodsecao, $sArea="")
    {
        $aFirstChild = Sitemap::getFirstChild(Sitemap::getProperty($iCodsecao, "codpai"), $sArea);
	return $aFirstChild['codsecao'] == $iCodsecao;
    }
	
    function isLastChild($iCodsecao, $sArea="")
    {
        $aLastChild = Sitemap::getLastChild(Sitemap::getProperty($iCodsecao, "codpai"), $sArea);
	return $aLastChild['codsecao'] == $iCodsecao;
    }
	
    function hasParent($iCodsecao)
    {
        return Sitemap::isChild($iCodsecao);
    }
	
    function hasChildren($iCodsecao, $sArea="")
    {
        return Sitemap::isParent($iCodsecao, $sArea);
    }
	
	//---------------------------------------------------------------------------
    
    function getProperty($iCodsecao, $sField="")
    {
        if(empty($sField))
            return false;		
        $aSecao = Sitemap::get($iCodsecao);
        return $aSecao[$sField];
    }
	
    function setProperty($iCodsecao, $sField, $sValue)
    {
        return mysql_query("update sitemap set {$sField}='{$sValue}' where codsecao={$iCodsecao}");
    }
	
    function getNextOrdem($iCodpai, $sArea="")
    {
        if(0 == $iCodpai)
        {
            if(!empty($sArea))
                $sWhereAdd = " and area='{$sArea}'";
            else
                Sitemap::throwError(__FUNCTION__, "Quando o primeiro parâmetro desta função for 0 (zero), é necessário informar a área!");
        }
		
	$sSql = "select max(ordem) as ordem from sitemap where codpai={$iCodpai} {$sWhereAdd}";
	$oRes = mysql_fetch_object(mysql_query($sSql));
		
	return $oRes->ordem + 1;
    }
	
    function getDescricao($iCodsecao)
    {
        return Sitemap::getProperty($iCodsecao, "descricao");
    }
	
    function getOrdem($iCodsecao)
    {
        return Sitemap::getProperty($iCodsecao, "ordem");
    }
	
	//---------------------------------------------------------------------------
    
    function getQtdConteudos($iCodsecao)
    {
        $sSql = "select count(*) as total from conteudos where codsecao={$iCodsecao}";
	$oRes = mysql_fetch_object(mysql_query($sSql));
		
	return $oRes->total;
    }
	
    function hasConteudo($iCodsecao)
    {
        return 0 < SiteMap::getQtdConteudos($iCodsecao);
    }
	
	//---------------------------------------------------------------------------
    
    function getBreadcrumb($iCodsecao)
    {
        $aDescricoes = array();
		
	while(0 != $iCodsecao)
        {
            $aDescricoes[]	= Sitemap::getDescricao($iCodsecao);
            $iCodsecao		= Sitemap::getProperty($iCodsecao, "codpai");
	}
		
	return array_reverse($aDescricoes);
    }
	
    function getFormattedBreadcrumb($iCodsecao, $sSeparador=" &raquo; ")
    {
        return implode($sSeparador, Sitemap::getBreadcrumb($iCodsecao));
    }
	
	//---------------------------------------------------------------------------
    
    function setString4Sql($sString)
    {
        return mysql_real_escape_string(utf8_decode(trim($sString)));
    }
	
    function replaceUrlKeywords($sUrl)
    {
        $aKeywords = array
        (
            "MY_URL/" => sEnderecoNormal
	);
		
        return str_replace(array_keys($aKeywords), array_values($aKeywords), $sUrl);
    }
	
    function getLink($mUrl, $sLabel, $sAttributes="")
    {
        if(is_array($mUrl))
        {
            $sUrl = $mUrl[0];
            $aUrl = explode("::", $sUrl);
			
            $aQueryParams = $mUrl[1];
			
            list($sUrl, $sQueryString) = explode("?", $aUrl[0]);
			
            $aQueryParams = _array_extend(_to_query_params($sQueryString), $aQueryParams);
            $sHref		  = $sUrl . "?" . _to_query_string($aQueryParams, $mUrl[2]);
	}
	else
        {
            $sUrl = $mUrl;
            $aUrl = explode("::", $sUrl);
			
            $sHref = $aUrl[0];
	}
		
	if(1 < count($aUrl) && "_blank" == $aUrl[1])
            return sprintf('<a href="#" onclick="window.open(\'%s\'); return false;"%s>%s</a>', $sHref, $sAttributes, $sLabel);
	else
            return sprintf('<a href="%s"%s>%s</a>', $sHref, $sAttributes, $sLabel);
    }
	
    function setUrl4Map($sUrl)
    {
        if(false === !!strpos($sUrl, "::"))
            return $sUrl;
		
        $aUrl = explode("::", $sUrl);
	return $aUrl[0];
    }
	
	//---------------------------------------------------------------------------
    
    function insert($iCodpai, $sDescricao, $sArea)
    {
        return mysql_query(sprintf("insert into sitemap set codpai=%s, descricao='%s', ordem=%s, ativo='S', area='%s', dtcadastro=now()", $iCodpai, Sitemap::setString4Sql($sDescricao), Sitemap::getNextOrdem($iCodpai, $sArea), $sArea));
    }
	
    function update($iCodsecao, $sDescricao)
    {
        return mysql_query(sprintf("update sitemap set descricao='%s', dtalteracao=now() where codsecao=%s", Sitemap::setString4Sql($sDescricao), $iCodsecao));
    }
	
    function remove($iCodsecao)
    {
        return mysql_query(sprintf("delete from sitemap where codsecao=%s", $iCodsecao));
    }
	
	//---------------------------------------------------------------------------
    
    function throwError($sFunction, $sError)
    {
        die(sprintf('<b>[%s]</b><br />%s', $sFunction, $sError));
    }	
}
?>