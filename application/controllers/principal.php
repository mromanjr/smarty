<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends CI_Controller {
    public function index()
    {
        $this->load->helper('form');
        $this->smarty->view('home.tpl');
    }
    
    public function conteudo()
    {
        $this->load->model('conteudo_model');
        $resultado = $this->conteudo_model->FillConteudo();        
        $this->smarty->assign("pagina","contato");
        $this->smarty->view("conteudo.tpl");
    }
}
