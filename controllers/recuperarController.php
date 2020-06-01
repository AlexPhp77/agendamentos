<?php 

class recuperarController extends controller{

	public function index(){

		$dados = array();
		$u = new Usuarios();

		$msg = '';
		if(isset($_POST['email']) && !empty($_POST['email'])){
			$email = addslashes($_POST['email']);

			if($u->setEmail($email) == false){
				$msg = "Digite um e-mail válido!";
			} else{
				$msg = $u->recuperarSenha();

				if($msg == false){
			    $msg = "O e-mail que você digitou não está cadastrado!";
				} else{
					$msg = "Um link de redefinição de senha foi enviado para o seu e-mail!<br/> Obs: pode ser que esteja na caixa de spam.";
				}  
			}
		}  

		

		$dados = array(
			'm' => $msg
		);
         
		$this->loadTemplate('recuperar_senha', $dados); 
	}
}