<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Conteudo_Model extends CI_Model
{
    // <editor-fold defaultstate="collapsed" desc="Construtores">
    public function __construct()     {
        parent::__construct();
    }
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Pesquisa">
    public function FillConteudo()     
    {
        return $this->db->get('conteudos')->result();        
    }
    
    public function FillDepartamentos()
    {        
        $this->db->select('colecao as departamento,codcolecao');
        return $this->db->get('colecoes')->result();
    }
    // </editor-fold>
}
?>