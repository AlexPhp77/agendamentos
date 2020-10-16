<?php 
class Cadastrar extends Conexao{

	private $nomecompleto;
	private $idade;	
	private $sexo;	
	private $cpf;
	private $email;
	private $telefone;
	private $senha;	
	private $estado;
	private $cidade;
	private $cep;
	private $rua;
	private $numero;

	private $id; 

    public function infoAllCadastrar($nomecompleto, $idade, $sexo, $cpf, $email, $telefone, $senha, $estado, $cidade, $cep, $rua, $numero){

    	$this->setNome($nomecompleto);
    	$this->setIdade($idade);
    	$this->setSexo($sexo);
    	$this->setCpf($cpf);
    	$this->setEmail($email);
    	$this->setFone($telefone);
        $this->setSenha($senha);
    	$this->setEstado($estado);
    	$this->setCidade($cidade);
    	$this->setCep($cep);
    	$this->setRua($rua);
    	$this->setNumero($numero);

    	if($this->cadastro()){
    		return true; 
    	} else{
    		return false;
    	}


    	
    }
    
    private function setId($id){
    	$this->id = $id;
    }  
    //Obs: Preciso filtrar antes de setar
	private function setNome($nomecompleto){		
		if($nomecompleto = filter_var($nomecompleto, FILTER_SANITIZE_STRING)){
			$this->nomecompleto = $nomecompleto; 
		} 
	}
	private function setIdade($idade){
		$this->idade = $idade;
	}
	private function setSexo($sexo){
		if($sexo = filter_var($sexo, FILTER_SANITIZE_STRING)){
			if($sexo == 'Masculino' or $sexo == 'Feminino'){
				$this->sexo = $sexo; 
			}
		} 
	}	
	private function setCpf($cpf){
		$this->cpf = $cpf;
	}
	public function setEmail($email){
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$this->email = $email;
			return true;  
		} else{
			return false; 
		}
	}private function setFone($telefone){		
		$this->telefone = $telefone; 		 	
	}
	public function setSenha($senha){
		if(strlen($senha) >= 8){
			$this->senha = $senha; 
			return true;             		
		} else{
			return false;
		}
	}
	private function setEstado($estado){
		$this->estado = $estado;
	}
	private function setCidade($cidade){
		if($cidade = filter_var($cidade, FILTER_SANITIZE_STRING)){
			$this->cidade = $cidade; 
		} 
	}
	private function setCep($cep){
		$this->cep = $cep;
	}
	private function setRua($rua){
		$this->rua = $rua;
	}
	private function setNumero($numero){
		if(filter_var($numero, FILTER_VALIDATE_INT)){
			$this->numero = $numero; 
			return true; 
		} 	
	}
	public function verificarEmail(){	

    	$sql = "SELECT * FROM usuarios WHERE email = :email";
    	$sql = $this->pdo->prepare($sql);
    	$sql->bindValue(':email', $this->email);
    	$sql->execute();

    	if($sql->rowCount() > 0){
    		return false;
    	} else{
    		return true;
    	}

    }
    public function verificarCpf(){	

    	$sql = "SELECT * FROM usuarios WHERE cpf = :cpf";
    	$sql = $this->pdo->prepare($sql);
    	$sql->bindValue(':cpf', $this->cpf);
    	$sql->execute();

    	if($sql->rowCount() > 0){
    		return false;
    	} else{
    		return true;
    	}

    }     
    private function cadastro(){    	

    	if($this->verificarEmail()){

    		if($this->verificarCpf()){
                
		    	$sql = $this->pdo->prepare("INSERT INTO usuarios SET nome = trim(:nome), idade = trim(:idade), sexo = :sexo, cpf = trim(:cpf), email = trim(:email), telefone = trim(:telefone), senha = md5(trim(:senha))");	    	
		    	$sql->bindValue(':nome', str_replace('  ', ' ', $this->nomecompleto));    	
		    	$sql->bindValue(':idade', $this->idade);
		    	$sql->bindValue(':sexo', $this->sexo);
		    	$sql->bindValue(':cpf',  str_replace(' ', '', $this->cpf));  
		    	$sql->bindValue(':email', $this->email);   	
		    	$sql->bindValue(':telefone', str_replace(' ', '', $this->telefone));	    	
		    	$sql->bindValue(':senha', $this->senha);		    	
		    	$sql->execute();
		        
		        /* Id da primeira inserção 
		        Tabela endereço terá o id do usuário inserido*/
		    	$id = $this->pdo->lastInsertId();

		    	if($id > 0){

			    	$sql = $this->pdo->prepare("INSERT INTO endereco SET id_usuario = :id_usuario, estado = trim(:estado), cidade = trim(:cidade), cep = trim(:cep), rua = trim(:rua), numero = trim(:numero)"); 
			    	$sql->bindValue(':id_usuario', $id);
			    	$sql->bindValue(':estado',  str_replace('  ', '', $this->estado)); 
			    	$sql->bindValue(':cidade', str_replace('  ', '', $this->cidade)); 
			    	$sql->bindValue(':cep', str_replace(' ', '', $this->cep)); 
			    	$sql->bindValue(':rua', str_replace('  ', '', $this->rua)); 
			    	$sql->bindValue(':numero', $this->numero);
			    	$sql->execute();   

			    	return true;   
		    	} 

		    	return false; 
	    	} 
    	}  
	}	

    public function captcha($codigo){

    	if($codigo == $_SESSION['captcha']){

    	$n = rand(1000, 9999);
        $_SESSION['captcha'] = $n; /*Após executado irá gerar outro código, acertando ou não.*/

		return true; 

		} else{
			return false; 
		}
    }
}


