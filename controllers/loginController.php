<?php 

class loginController extends controller{

	public function index(){

		$dados = array();	

		$u = new Funcionarios();

		if(isset($_POST['email']) && !empty($_POST['senha'])){

			$email = addslashes($_POST['email']);
			$senha = addslashes($_POST['senha']);
			$codigo = addslashes($_POST['codigo']);
            
            $m = '';
            $m2 = '';
			if($u->captcha($codigo)){
				$m2 = $u->login($email, $senha);	
			} else{
				$m = "Código inválido!";
			}			

			if($m2== false && is_bool($m2)){
				$m2 = "E-mail e/ou senha errados!";				
			}			

			$dados = array(
			    'm' => $m,
			    'm2' => $m2
		    ); 			   
		}		
         
		$this->loadTemplate('login', $dados); 	
	}
}