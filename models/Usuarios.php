<?php 
class Usuarios extends Conexao{

	private $nomecompleto;
	private $idade;	
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

    public function infoAllCadastrar($nomecompleto, $idade, $cpf, $email, $telefone, $senha, $estado, $cidade, $cep, $rua, $numero){

    	$this->setNome($nomecompleto);
    	$this->setIdade($idade);
    	$this->setCpf($cpf);
    	$this->setEmail($email);
    	$this->setFone($telefone);
        $this->setSenha($senha);

    	$this->setEstado($estado);
    	$this->setCidade($cidade);
    	$this->setCep($cep);
    	$this->setRua($rua);
    	$this->setNumero($numero);

    	if($this->cadastrar()==true){
    		return true; 
    	} else{
    		return false;
    	}


    	
    }
    public function infoAllEditar($nomecompleto, $idade, $cpf, $email, $telefone, $estado, $cidade, $cep, $rua, $numero, $id){

    	$this->id = $id; 

    	$this->setNome($nomecompleto);
    	$this->setIdade($idade);
    	$this->setCpf($cpf);
    	$this->setEmail($email);
    	$this->setFone($telefone);
    	$this->setEstado($estado);
    	$this->setCidade($cidade);
    	$this->setCep($cep);
    	$this->setRua($rua);
    	$this->setNumero($numero);

    	$this->editarPaciente();
    }  
    private function setId($id){
    	$this->id = $id;
    }  
    //Obs: Preciso filtrar antes de setar
	private function setNome($nomecompleto){
		$this->nomecompleto = $nomecompleto;
	}
	private function setIdade($idade){
		$this->idade = $idade;
	}
	private function setCpf($cpf){
		$this->cpf = $cpf;
	}
	private function setEmail($email){
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$this->email = $email; 
		} 
	}private function setFone($telefone){		
		$this->telefone = $telefone; 		 	
	}
	private function setSenha($senha){
		if(strlen($senha) >= 8){
			$this->senha = $senha;             		
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
    public function permissoes(){  

	        if(isset($_SESSION['logado'])){       
	        
	    	$sql = $this->pdo->prepare('SELECT permissoes FROM usuarios WHERE id = :id');
	        $sql->bindValue(':id', $_SESSION['logado']);
	        $sql->execute();        

	        if($sql->rowCount() > 0){
	            return $dado = $sql->fetch(); 
	        }
        }
    }    
    private function cadastrar(){    	

    	if($this->verificarEmail()){

	    	$sql = $this->pdo->prepare("INSERT INTO usuarios SET nome = trim(:nome), idade = trim(:idade), cpf = trim(:cpf), email = trim(:email), telefone = trim(:telefone), senha = trim(:senha)");
	    	$sql->bindValue(':nome', str_replace('  ', '', $this->nomecompleto));    	
	    	$sql->bindValue(':idade', $this->idade);
	    	$sql->bindValue(':cpf',  str_replace(' ', '', $this->cpf));  
	    	$sql->bindValue(':email', $this->email);   	
	    	$sql->bindValue(':telefone', str_replace(' ', '', $this->telefone));
	    	$sql->bindValue(':senha',str_replace(' ', '', $this->senha));
	    	$sql->execute();
	        
	        /* Id da primeira inserção 
	        Tabela endereço terá o id do usuário inserido*/
	    	$id = $this->pdo->lastInsertId();

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
	}
	private function editarPaciente(){

		$sql = $this->pdo->prepare("UPDATE usuarios SET nome = trim(:nome), idade = trim(:idade), cpf = trim(:cpf), email = trim(:email), telefone = trim(:telefone) WHERE id = trim(:id)");
    	$sql->bindValue(':nome', str_replace('  ', '', $this->nomecompleto));    	
    	$sql->bindValue(':idade', $this->idade);
    	$sql->bindValue(':cpf',  str_replace(' ', '', $this->cpf));  
    	$sql->bindValue(':email', $this->email);   	
    	$sql->bindValue(':telefone', str_replace(' ', '', $this->telefone));
    	$sql->bindValue(':id', $this->id);    	
    	$sql->execute(); 

    	$sql = $this->pdo->prepare("UPDATE endereco SET estado = trim(:estado), cidade = trim(:cidade), cep = trim(:cep), rua = trim(:rua), numero = trim(:numero) WHERE id_usuario = trim(:id)"); 
    	$sql->bindValue(':id', $this->id);
    	$sql->bindValue(':estado',  str_replace('  ', '', $this->estado)); 
    	$sql->bindValue(':cidade',  str_replace('  ', '', $this->cidade)); 
    	$sql->bindValue(':cep', str_replace(' ', '', $this->cep)); 
    	$sql->bindValue(':rua', str_replace('  ', '', $this->rua)); 
    	$sql->bindValue(':numero', $this->numero);    	 
    	$sql->execute();

    	return true; 
	}
	public function login($email, $senha){			 

		$sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
		$sql->bindValue(':email', $email);
		$sql->bindValue(':senha', $senha);
		$sql->execute();

		if($sql->rowCount() > 0){
			$dado = $sql->fetch();
			$_SESSION['logado'] = $dado['id'];
			?>
        	<script type="text/javascript">window.location.href="./";</script>
        	<?php  
		} else{
			return false;   		     
	    }		     
	} 
	public function qtUsuarios(){
		$dados = array();
		$sql = $this->pdo->query("SELECT COUNT(*) as c FROM usuarios");        
        if($sql->rowCount() > 0){
        	$dados = $sql->fetch();
        	return $dados['c'];
        } return $dados;
	}
	public function getUsuarios($inicio, $total_reg){		 

        $dados = array();
		$sql = $this->pdo->query("SELECT id, nome, cpf, email, telefone, permissoes FROM usuarios ORDER BY nome ASC LIMIT $inicio , $total_reg");        
        if($sql->rowCount() > 0){
        	return $dados = $sql->fetchAll();
        } return $dados; 
	}

	public function deletar($id){

    	$sql = $this->pdo->prepare('DELETE FROM usuarios WHERE id = :id');
    	$sql->bindValue(':id', $id);
    	$sql->execute();

    	?>
    	<script type="text/javascript">window.location.href="<?php echo BASE_URL; ?>./"</script>
    	<?php
    }

	public function pesquisar($texto){
		$dados = array(); 
        /*Preciso melhorar pesquisa*/
		$sql = $this->pdo->prepare("SELECT id, nome FROM usuarios WHERE nome LIKE :texto");
		$sql->bindValue(':texto', "%".$texto."%");		
		$sql->execute(); 

		if($sql->rowCount() > 0){
			$dados = $sql->fetchAll();
			return $dados;
		} return $dados;

	}

	public function getPaciente($id){
        $dados = array();
		$sql = $this->pdo->prepare("SELECT usuarios.id, usuarios.nome, usuarios.idade, usuarios.cpf, usuarios.email, usuarios.telefone, endereco.estado, endereco.cidade, endereco.cep, endereco.rua, endereco.numero FROM usuarios INNER JOIN endereco ON endereco.id_usuario = usuarios.id WHERE usuarios.id= :id");
		$sql->bindValue(':id', $id);
		$sql->execute();

		if($sql->rowCount() > 0){
			$dados = $sql->fetchAll();
			return $dados;
		} else{
			return $dados; 
		}
	}	
}