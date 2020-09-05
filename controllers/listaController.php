<?php 

class listaController extends controller{
	
	public function index(){
		
        $dados = array(); 

        $users = new Usuarios();
		$dados = $users->getPacientes();  

		if(isset($_SESSION['logadoFuncionario'])){
			 $this->loadTemplate('lista', $dados);
		} else{
			header('Location: '.BASE_URL.'login');
		} 
	}
}