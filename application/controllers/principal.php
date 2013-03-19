<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends CI_Controller {    
    
    // <editor-fold defaultstate="collapsed" desc="Construtores">
    public function __construct() 
    {
        parent:: __construct();
        $this->load->model('conteudo_model');        
    }
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Propriedades">
    private $departamento = array();
    private $codcolecao = array();
    
    private function SetDepartamentos($pDepartamento,$pKey)
    {   
        $this->departamento[$pKey] = $pDepartamento;        
    }
    
    private function SetCodColecao($pCodColecao,$pKey)
    {
        $this->codcolecao[$pKey] = $pCodColecao;
    }
    
    private function GetDepartamento($key = NULL)
    {   
        if(isset($key))
        {
            return $this->departamento[$key];
        }
        else
        {
            return $this->departamento;
        }        
    }
    
    private function GetCodColecao($key = null)
    {
        if (isset($key))
        {
            return $this->codcolecao[$key];
        }
        else
        {
            return $this->codcolecao;
        }
        
    }
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Navegação"> 
    public function index()
    {   
        $this->PesquisarConteudos(1);
        $this->smarty->assign("departamentos",$this->GetDepartamento());
        $this->smarty->assign("codcolecao",$this->GetCodColecao());
        $this->load->helper('form');
        $this->smarty->view('home.tpl');
    }


    public function institucional()
    {
        $this->smarty->assign("pagina", "contato");
        $this->smarty->view("conteudo.tpl");
    }
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Pesquisas">
    private function PesquisarConteudos($Flag)
    {
        switch($Flag)
        {
            case 1:
            {
                $resultado = $this->conteudo_model->FillDepartamentos();        
                
                foreach($resultado as $key => $row)
                {
                    $this->SetDepartamentos($row->departamento,$key);
                    $this->SetCodColecao($row->codcolecao,$key);
                }
            }
        }        
    }

// </editor-fold>
}