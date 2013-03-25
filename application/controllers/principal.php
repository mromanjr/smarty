<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends CI_Controller
{   
    // <editor-fold defaultstate="collapsed" desc="Construtores">
    public function __construct() 
    {   
        parent::__construct();
        session_start();
        
        $this->load->model('conteudo');                          
        $logo = array
        (
            "src" => base_url() . 'resources/images/topo/logo.jpg',
            "style" => 'margin-top:1px; margin-left:1px;'
        );                   
        $this->smarty->assign('logo',$logo);
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Requisições"> 
    public function index()
    {           
        $menu = unserialize($this->SerializeMenu());        
        $this->smarty->assign("menu",$menu->GetMenu());
        $this->smarty->assign("ItensMenu",$menu->GetItensMenu());
        $this->GetSlider();             
        $this->smarty->view('home.tpl');
    }
    
    public function institucional()
    {   
        $menu = unserialize($this->SerializeMenu());        
        $this->smarty->assign("menu",$menu->GetMenu());
        $this->smarty->assign("ItensMenu",$menu->GetItensMenu());
        $this->GetSlider();
        $this->smarty->assign("pagina", "contato");
        $this->smarty->view("conteudo.tpl");
    }
    
    public function banner($area,$cod)
    {        
        if ($area == "slider") 
        {
            $res = $this->conteudo->GetSlider($cod);
            $caminho = base_url() . "uploads/" . $res[0]->banner;        
            header ("Content-Type: image");
            readfile($caminho);
        }
        else
        {
            $res = $this->conteudo->GetInformativos($cod);
            if ($res != false) 
            {
                $caminho = base_url() . "uploads/" . $res[0]->banner;        
                header ("Content-Type: image");
                echo $caminho;   
            }
            else 
            {
                echo "Falso";

            }                     
        }        
    }
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos">
    private function SerializeMenu()   
    {
        if (!isset($_SESSION['menu']))
        {
            $res = $this->conteudo->GetDepartamentos();
            $ItensMenu = array();
            $I = 0;
            foreach ($res as $row)
            {
                $ItensMenu[$I] = $this->conteudo->GetItensDepartamento($row->codcolecao,true);
                $I++;
            }     
            $this->conteudo->SetMenu($res);
            $this->conteudo->SetItensMenu($ItensMenu);            
            
            $_SESSION['menu'] = serialize($this->conteudo);
            return $_SESSION['menu'];
        }
        else
        {            
            return $_SESSION['menu'];
        }        
    }
    
    private function GetSlider()
    {
        $res = $this->conteudo->GetSlider();        
        if ($res != FALSE) 
        {
            $this->smarty->assign("slider",$res);
        }    
    }
// </editor-fold>
}