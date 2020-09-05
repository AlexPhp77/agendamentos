<?php 

class tabelaController extends controller{

	
	public function index(){		

		$dados = array(); 

		$users = new Usuarios();
		$dados = $users->getPacientes();

		if(isset($_SESSION['logadoFuncionario'])){
			echo json_encode($dados);	
		} else{
			header('Location: '.BASE_URL.'login');
		}			
	}
}
