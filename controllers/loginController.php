<?php 

class loginController extends controller{

	public function index(){

		$dados = array();	

		$u = new Usuarios();		

		if(isset($_POST['email']) && !empty($_POST['senha'])){

			$email = addslashes($_POST['email']);
			$senha = addslashes($_POST['senha']);

			$m = $u->login($email, $senha);	

			if($m == false){
				$m = "E-mail e/ou senha errados!";
				
			}

			$dados = array(
			    'm' => $m
		    ); 			   
		}		
         
		$this->loadTemplate('login', $dados); 	
	}
}