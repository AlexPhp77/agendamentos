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
            $m2 = '';  
           					
			$m = $u->infoAllCadastrar($nomecompleto, $idade, $cpf, $email, $telefone, $senha, $estado, $cidade, $cep, $rua, $numero);	

			
			if($m == true){
				$m = "Cadastrado com sucesso!";				
			} else {
				$m2 = "Erro!";
			}

			$m3 = $u->verificarEmail();		


			  
		    if($m3 == false && $m == false){
		        $m3 = "Esse e-mail já está sendo usado!";		       
		    } else{
		    	$m3 = '';
		    }

            $dados = array(
		       'm' => $m,
		       'm2' => $m2,
		       'm3' => $m3		     
		    );
		}	
         
		$this->loadTemplate('cadastro', $dados); 	
	}
}