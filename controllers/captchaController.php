<?php 

class captchaController extends controller{

	public function index(){

		$dados = array();	

		$u = new Usuarios();

		$u->captcha();				
         
		$this->loadTemplate('login', $dados); 	
	}
}