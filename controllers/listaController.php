<?php 

class listaController extends controller{	
	
	public function index(){
		
        $dados = array();

        //$get = new Usuarios();      

        //$dados = $get->getPacientes();     

		//json_encode($dados); 
             
        $this->loadTemplate('lista', $dados);
        //$this->loadView('lista', $dados); 	
	}
}