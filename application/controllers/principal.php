<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends MY_BaseControler
{   
    // <editor-fold defaultstate="collapsed" desc="Construtores">
    public function __construct() 
    {        
        parent::__construct();
        $this->load->model('conteudo_model');        
        $this->load->model('produtos_model');
        
        $logo = array
        (
            "src" => base_url() . 'resources/images/topo/logo.jpg',
            "style" => 'margin-top:1px; margin-left:1px;'
        );           
        
        $this->smarty->assign('logo',$logo);
        
        $menu = parent::GetMenu();
        $ItensMenu = parent::GetItensMenu();
        if(empty($menu) && empty($ItensMenu))
        {
            $res = $this->conteudo_model->GetDepartamentos();
            $ItensMenu = array();
            $I = 0;
            foreach ($res as $row)
            {
                $ItensMenu[$I] = $this->conteudo_model->GetItensDepartamento($row->codcolecao,true);
                $I++;
            }        

            $this->SetMenu($res);
            $this->SetItensMenu($ItensMenu);

            $this->smarty->assign("menu",  $this->GetMenu());
            $this->smarty->assign("ItensMenu",  $this->GetItensMenu());
        }
        else {
            die("aa");
        } 
    }
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos"> 
    public function index()
    {   
        $this->load->model("produtos_model");
        $res = $this->conteudo_model->GetSlider();
        
        if ($res != FALSE) 
        {
            $this->smarty->assign("slider",$res);
        }        
        
        $this->smarty->view('home.tpl');
    }


    public function institucional()
    {   
        $menu = parent::GetMenu();
        $itensMenu = parent::GetItensMenu();
        
        $this->smarty->assign("menu",$menu);
        $this->smarty->assign("ItensMenu",$itensMenu);        
        
        
        $this->smarty->assign("pagina", "contato");
        $this->smarty->view("conteudo.tpl");
    }
    
    public function banner($area,$cod)
    {        
        if ($area == "slider") 
        {
            $res = $this->conteudo_model->GetSlider($cod);
            $caminho = base_url() . "uploads/" . $res[0]->banner;        
            header ("Content-Type: image");
            readfile($caminho);
        }
        else
        {
            $res = $this->conteudo_model->GetInformativos($cod);
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
    
    // <editor-fold defaultstate="collapsed" desc="Pesquisas">
    private function PesquisarConteudos($Flag)
    {
        switch($Flag)
        {
            case 1:
            {
                $resultado = $this->conteudo_model->GetDepartamentos();        
                
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