<?php 

class tabelaController extends controller{

	public function index(){

		$dados = array(); 

		$users = new Usuarios();
		$dados = $users->getPacientes();

		echo json_encode($dados);

		$this->loadView('tabela', $dados); 	
	}
}
//preciso usar um viu sem html só com json 