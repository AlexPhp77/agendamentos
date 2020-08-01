<?php 

class cadastro_funcionarioController extends controller{

	public function index(){

		$dados = array();	

		$u = new Funcionarios();	
		$p = $u->permissoes();



		if(isset($_POST['cpf']) && !empty($_POST['cpf']) && isset($_POST['email']) && !empty($_POST['email']) ){

			$nome = ucwords(addslashes($_POST['nome']));
			$sobrenome = ucwords(addslashes($_POST['sobrenome']));
			$nomecompleto =  $nome.'  '.$sobrenome;			
			$idade = addslashes($_POST['idade']);
			$sexo = addslashes($_POST['sexo']);
			$cpf = addslashes($_POST['cpf']);
			$email = addslashes($_POST['email']);
			$telefone = addslashes($_POST['telefone']);
			$senha = '';
			if(!empty($_POST['senha'])){
				$senha = addslashes($_POST['senha']);
			}
			$estado = addslashes($_POST['estado']);
			$cidade = addslashes($_POST['cidade']);
			$cep = addslashes($_POST['cep']);
			$rua = addslashes($_POST['rua']);
			$numero = addslashes($_POST['numero']);
			
			if(!empty($_POST['nivelacesso'])){
				$acesso = addslashes($_POST['nivelacesso']);
			}
			$codigo = '';
			if(!empty($_POST['codigo'])){
				$codigo = addslashes($_POST['codigo']);
			}
            
            $m = '';
            $m2 = ''; 



			if($u->captcha($codigo) or $p['permissoes'] == 'SECRETARIO'){
				$m = $u->infoAllCadastrar($nomecompleto, $idade, $sexo, $cpf, $email, $telefone, $senha, $estado, $cidade, $cep, $rua, $numero, $acesso);
			} else{
				$m = "Código inválido!";
			}
			
			if($m == true){
				$m = "Cadastrado com sucesso!";				
			} else {
				$m2 = "Erro!";
			}

			$m3 = $u->verificarEmail();		

            $m4 = $u->setSenha($senha);
            if($m4 == false && $senha = ''){
            	$m4 = "Sua senha deve ter 8 ou mais caracteres!";
            } else{
            	$m4 = '';
            }

            $m5 = $u->setEmail($email);

            if($m5 == false && $email = ''){
            	$m5 = "Digite um e-mail válido!";
            } else{
            	$m5 = '';
            }
			  
		    if($m3 == false and $m == false){
		        $m3 = "Esse e-mail já está sendo usado!";		       
		    } else{
		    	$m3 = '';
		    }
            
            $m6 = $u->verificarCpf(); 
            if($m6 == false and $m == false){
		        $m6 = "Esse CPF já está cadastrado!";		       
		    } else{
		    	$m6 = '';
		    }

            $dados = array(
		       'm' => $m,
		       'm2' => $m2,
		       'm3' => $m3,
		       'm4'	=> $m4,
		       'm5' => $m5,
		       'm6' => $m6
		      
		    );
		}	
		
		$dados['permissao'] = $p;
        
		$this->loadTemplate('cadastro_funcionario', $dados); 	
	}
}