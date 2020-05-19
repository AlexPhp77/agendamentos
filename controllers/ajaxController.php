<?php 

class ajaxController extends controller{	
	
	public function index(){
		
		$dados = array(
            'pesquisado' => ''
		);

        $u = new Usuarios();        

		if(isset($_POST['busca']) && !empty($_POST['busca'])){
			$texto = addslashes($_POST['busca']); 
			$retorno = $u->pesquisar($texto);			

			$dados = array(
			'pesquisado' => $retorno 
		    );
		}		
       
		$this->loadView('ajax', $dados);		
			
	}		
}