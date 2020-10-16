<?php 

class cadastrarController extends controller{

	public function index(){

		$dados = array();	

		$u = new Cadastrar();		

		if(isset($_POST['cpf']) && !empty($_POST['cpf']) && !empty($_POST['sexo'])){

			$nome = ucwords(addslashes($_POST['nome']));
			$sobrenome = ucwords(addslashes($_POST['sobrenome']));
			$nomecompleto =  $nome.'  '.$sobrenome;			
			$idade = addslashes($_POST['idade']);
			$sexo = addslashes($_POST['sexo']);
			$cpf = addslashes($_POST['cpf']);
			
			if(!empty($_POST['email']) && isset($_POST['email'])){	
                $email = $_POST['email'];
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					$m3 = "Digite um e-mail válido!";
				} 
			} 

			$telefone = addslashes($_POST['telefone']);
			$senha = '';
			if(!empty($_POST['senha'])){
				$senha = addslashes($_POST['senha']);
			} else{
				$m3 = "Digite sua senha!"; 
			}
			$estado = addslashes($_POST['estado']);
			$cidade = addslashes($_POST['cidade']);
			$cep = addslashes($_POST['cep']);
			$rua = addslashes($_POST['rua']);
			$numero = addslashes($_POST['numero']);
			
			$codigo = '';
			if(!empty($_POST['codigo'])){
				$codigo = addslashes($_POST['codigo']);
			}


            
            $m = '';
            $m2 = ''; 
          
			if($u->captcha($codigo)){
				$m = $u->infoAllCadastrar($nomecompleto, $idade, $sexo, $cpf, $email, $telefone, $senha, $estado, $cidade, $cep, $rua, $numero);
				if($m == true){
				$m = "Cadastrado com sucesso! <a href=".BASE_URL."login_cliente>Área para LOGIN</a>";				
				} else {
					$m2 = "Erro!";
				}
			} else{
				$m3 = "Código inválido!";
			}
			
			

			$m3 = $u->verificarEmail();		

            $m4 = $u->setSenha($senha);
            if($m4 == false && $senha = ''){
            	$m4 = "Sua senha deve ter 8 ou mais caracteres!";
            } else{
            	$m4 = '';
            }
            
            $m5 = '';
            if(!empty($email)){   
                $m5 = $u->setEmail($email);
            }

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
		
		
        
		$this->loadTemplate('add', $dados); 	
	}
}