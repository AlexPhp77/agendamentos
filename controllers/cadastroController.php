<?php 

class cadastroController extends controller{

	public function index(){

		$dados = array();	

		$u = new Usuarios();		

		if(isset($_POST['email']) && !empty($_POST['senha'])){

			$nome = addslashes($_POST['nome']);
			$sobrenome = addslashes($_POST['sobrenome']);
			$nomecompleto = $nome.' '.$sobrenome;
			$idade = addslashes($_POST['idade']);
			$cpf = addslashes($_POST['cpf']);
			$email = addslashes($_POST['email']);
			$telefone = addslashes($_POST['telefone']);
			$senha = addslashes($_POST['senha']);
			$estado = addslashes($_POST['estado']);
			$cidade = addslashes($_POST['cidade']);
			$cep = addslashes($_POST['cep']);
			$rua = addslashes($_POST['rua']);
			$numero = addslashes($_POST['numero']);
            
            $m = '';
            
						
			$u->infoAllCadastrar($nomecompleto, $idade, $cpf, $email, $telefone, $senha, $estado, $cidade, $cep, $rua, $numero);			

            $dados = array(
		       'm' => $m 
		    );
		}	
         
		$this->loadTemplate('cadastro', $dados); 	
	}
}