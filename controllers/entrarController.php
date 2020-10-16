<?php 

class entrarController extends controller{

	public function index(){

		$dados = array();			
         
		$this->loadTemplate('entrar', $dados); 	
	}
}