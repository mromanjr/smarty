<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Converte qualquer string passada para um formato compatível com URLs. 
 * @param string $strParametro string a ser passada na URL
 * @return string
 */
function UrlAmigavelReplace($strParametro)
{       
    $remover = array("&");    
    
    $strNovo = strtolower(trim(str_replace($remover," ",$strParametro)));
    $array = explode(" ",trim($strNovo));   
    
    $final = "";    
    
    foreach($array as $indice => $palavra)
    {     
        if (strlen($palavra) >= 1) 
        {
            if ($indice == count($array) - 1) 
            {
                $final .= $palavra;
            }
            else
            {
                $final .= $palavra . "-";                          
            }
        }                
    }    
    return RemoveAcentos($final);    
}


/**
 * Função que retira todos acentos e retorna a string nova
 * 
 * @param string $string String com acentos
 * @return string
 */
function RemoveAcentos($string)
{

    $a = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ";
    

    $b = "aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr";
    

    $string = utf8_decode($string);


    $string = strtr($string, utf8_decode($a), $b); 

    $string = str_replace(" ","",$string);

    $string = strtolower($string); 

    return utf8_encode($string); 
}

?>
