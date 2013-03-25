<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produtos extends CI_Controller 
{   
    // <editor-fold defaultstate="collapsed" desc="Construtores">
    public function __construct() 
    {
        parent:: __construct();
        $this->load->model('conteudo_model');        
    }
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos"> 
    public function index()
    {
        
    }
    // </editor-fold>
}