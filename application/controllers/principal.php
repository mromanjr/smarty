<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends CI_Controller {
	public function index()
	{	
		$this->smarty->view('home.tpl');
	}
}
