<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Produtos_Model extends CI_Model
{
    // <editor-fold defaultstate="collapsed" desc="Construtores">
    public function __construct()     
    {
        parent::__construct();        
    }
    // </editor-fold>
    
    public function FillSlider()
    {
        $hoje = date("Y-m-d");
        
        $query = $this->db
                    ->where('dtini <=',$hoje)
                    ->where('dtfim >=',$hoje)
                    ->where('localizacao','index')
                    ->get('slider');               
        
        if ($query->num_rows() > 0) 
        {
            return $query->result();
        }
        else            
        {
            return false;
        }
        
//        $sql = "select * from slider where dtini<='$hoje' and dtfim>='$hoje' and localizacao='index' ";
//        $stmt = mysql_query($sql);
//        $num = mysql_num_rows($stmt);
//
//        if($num > 0)
//        {
//            $html  = "<div class='slider'>";
//            $html .= "<div id='coin-slider'>";
//            while($rsSlider = mysql_fetch_object($stmt))
//            {
//                $html .= "<a href='$rsSlider->url' target='$rsSlider->target'>
//                <img src=".sEnderecoNormal."banner.php?_s=$rsSlider->codbanner /><span>$rsSlider->descricao</span>
//                </a>";    
//            }
//            $html .= "</div>";
//            $html .= "</div>";
//            echo $html;
//        }
    }
}
?>
