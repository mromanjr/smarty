<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Conteudo_Model extends CI_Model
{
    // <editor-fold defaultstate="collapsed" desc="Construtores">
    public function __construct()     {
        parent::__construct();
    }
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Pesquisa">
    public function GetConteudo()     
    {
        return $this->db->get('conteudos')->result();        
    }
    
    public function GetDepartamentos()
    {        
        return $this->db
                ->select('colecao as departamento,codcolecao')
                ->get('colecoes')->result();        
    }
    
    public function GetItensDepartamento($codcolecao,$temestoque = true)
    {
        if ($temestoque) 
        {
            return $this->db
                    ->select("ps.tipoproduto,ps.codcolecao,ps.codtipoproduto")
                    ->join("produtos_departamentos pd","ps.codproduto = pd.codproduto","inner")
                    ->join("tipos_produtos tp","ps.codtipoproduto = tp.codtipoproduto","inner")
                    ->join("estoque_loja es","ps.codtamcor = es.codtamcor","inner")
                    ->where("pd.codcolecao","'$codcolecao'",false)
                    ->where("ps.ativo","'S'",false)
                    ->where("es.qtdestoque >","'0'",false)
                    ->group_by("ps.codtipoproduto",false)
                    ->order_by("tp.prioridade",false)
                    ->get("vw_produtos_site ps")
                    ->result();
        }
        else
        {
            return $this->db
                    ->select("ps.tipoproduto,ps.codcolecao,ps.codtipoproduto")
                    ->join("produtos_departamentos pd","ps.codproduto = pd.codproduto","inner")
                    ->join("tipos_produtos tp","ps.codtipoproduto = tp.codtipoproduto","inner")                    
                    ->where("pd.codcolecao","'$codcolecao'",false)
                    ->where("ps.ativo","'S'",false)                    
                    ->group_by("ps.codtipoproduto",false)
                    ->order_by("tp.prioridade",false)
                    ->get("vw_produtos_site ps")
                    ->result();            
        }
    }
    
    public function GetInformativos($codbanner)
    {
        $query = $this->db
                ->select("banner")                
                ->where("codbanner = '$codbanner'")
                ->get("banners");
        
        if ($query->num_rows() > 0) 
        {            
            return $query
                    ->result();
        }
        else
        {
            return false;
        }       
    }
    
    public function GetSlider($codbanner = NULL)  
    {
        if (isset($codbanner)) 
        {
            return $this->db
                    ->select('banner')
                    ->where("codbanner = '$codbanner'")
                    ->get('slider')
                    ->result();
        }         
        else
        {
            $hoje = date("Y-m-d");

            $query = $this->db
                    ->where('dtini <=', $hoje)
                    ->where('dtfim >=', $hoje)
                    ->where('localizacao', 'index')
                    ->get('slider');

            if ($query->num_rows() > 0) 
            {
                return $query->result();
            }            
            else 
            {
                return false;
            }
        }
    }
    // </editor-fold>
}
?>