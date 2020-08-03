<?php 

class listaController extends controller{	
	
	public function index(){
		
        $dados = array();

	
             
        $this->loadTemplate('lista', $dados);
	}	

}