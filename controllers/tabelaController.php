<?php 

class tabelaController extends controller{

	public function index(){

		$dados = array(); 

		$users = new User();
		$dados = $users->getUsers();

		echo json_encode($dados);

		$this->loadView('tabela', $dados); 	
	}
}
//preciso usar um viu sem html só com json 