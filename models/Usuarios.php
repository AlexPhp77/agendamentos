<?php 
class Usuarios extends Conexao{

	private $nomecompleto;
	private $idade;	
	private $sexo;	
	private $cpf;
	private $email;
	private $telefone;
	private $senha;
	private $nivelacesso; 
	private $estado;
	private $cidade;
	private $cep;
	private $rua;
	private $numero;
	private $id; 

    public function infoAllCadastrar($nomecompleto, $idade, $sexo, $cpf, $email, $telefone, $senha, $estado, $cidade, $cep, $rua, $numero, $nivelacesso){

    	$this->setNome($nomecompleto);
    	$this->setIdade($idade);
    	$this->setSexo($sexo);
    	$this->setCpf($cpf);
    	$this->setEmail($email);
    	$this->setFone($telefone);
        $this->setSenha($senha);
        $this->setPermissoes($nivelacesso);

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
    public function infoAllEditar($nomecompleto, $idade, $sexo, $cpf, $email, $telefone, $estado, $cidade, $cep, $rua, $numero, $id){

    	$this->id = $id; 

    	$this->setNome($nomecompleto);
    	$this->setIdade($idade);
    	$this->setSexo($sexo);
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
	private function setPermissoes($nivelacesso){
		if($nivelacesso = filter_var($nivelacesso, FILTER_SANITIZE_STRING)){
			if($nivelacesso == 'DOUTOR' or $nivelacesso == 'SECRETARIO'){
				$this->nivelacesso = $nivelacesso; 
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
		} else{
			return false; 
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
    public function permissoes(){  

	        if(isset($_SESSION['logado'])){       
	        
	    	$sql = $this->pdo->prepare('SELECT permissoes FROM funcionarios WHERE id = :id');
	        $sql->bindValue(':id', $_SESSION['logado']);
	        $sql->execute();        

	        if($sql->rowCount() > 0){
	           
	            $dado = $sql->fetch();
                return $dado; 
	        }
        }
    }    
    private function cadastrar(){    	

    	if($this->verificarEmail()){

    		if($this->verificarCpf()){

		    	$sql = $this->pdo->prepare("INSERT INTO usuarios SET permissoes = :permissoes, nome = trim(:nome), idade = trim(:idade), sexo = :sexo, cpf = trim(:cpf), email = trim(:email), telefone = trim(:telefone), senha = md5(trim(:senha))");	    	
		    	$sql->bindValue(':nome', str_replace('  ', ' ', $this->nomecompleto));    	
		    	$sql->bindValue(':idade', $this->idade);
		    	$sql->bindValue(':sexo', $this->sexo);
		    	$sql->bindValue(':cpf',  str_replace(' ', '', $this->cpf));  
		    	$sql->bindValue(':email', $this->email);   	
		    	$sql->bindValue(':telefone', str_replace(' ', '', $this->telefone));	    	
		    	$sql->bindValue(':senha', $this->senha);
		    	$sql->bindValue(':permissoes', $this->nivelacesso);
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
	    	} 
    	}  
	}
	private function editarPaciente(){

		$sql = $this->pdo->prepare("UPDATE usuarios SET nome = trim(:nome), idade = trim(:idade), sexo = :sexo, cpf = trim(:cpf), email = trim(:email), telefone = trim(:telefone) WHERE id = trim(:id)");
    	$sql->bindValue(':nome', str_replace('  ', '', $this->nomecompleto));    	
    	$sql->bindValue(':idade', $this->idade);
    	$sql->bindValue(':sexo', $this->sexo);
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
		$sql->bindValue(':senha', md5($senha));
		$sql->execute();

		if($sql->rowCount() > 0){
			$dado = $sql->fetch();
			$_SESSION['logado'] = $dado['id'];
		    //return true; 
			?>
        	<script type="text/javascript">window.location.href="<?php echo BASE_URL; ?>usuario";</script>
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
		$sql = $this->pdo->query("SELECT id, nome, cpf, email, telefone FROM usuarios ORDER BY nome ASC LIMIT $inicio , $total_reg");        
        if($sql->rowCount() > 0){
        	$dados = $sql->fetchAll();
        } return $dados; 
	}

	public function getPacientes(){		 

       $dados = array();

		$sql = $this->pdo->query("SELECT nome,idade,sexo,cpf,email, telefone, id FROM usuarios ORDER BY nome ASC");   

		$qtregistros = $sql->rowCount(); 

   
		if($sql->rowCount() > 0){    
		       

	       $dados = array(

	        'draw' => 1,
	        'recordsTotal' => $qtregistros,
	        'recordsFiltered' => 12,	       
	        'data' => $sql->fetchAll()
	        );  
		}  

		return $dados;

	}

	public function deletar($id){

        //$dados = $this->permissoes(); 


		if(1==1 /*$dados['permissoes'] == 'SECRETARIO'*/){		

	    	$sql = $this->pdo->prepare('DELETE FROM reserva WHERE id_usuario = :id');
	    	$sql->bindValue(':id', $id);
	    	$sql->execute();

	    	$sql = $this->pdo->prepare('DELETE FROM endereco WHERE id_usuario = :id');
	    	$sql->bindValue(':id', $id);
	    	$sql->execute();

	    	$sql = $this->pdo->prepare('DELETE FROM usuarios WHERE id = :id');
	    	$sql->bindValue(':id', $id);
	    	$sql->execute();

        } else{

        	$sql = $this->pdo->prepare('DELETE usuarios, endereco FROM usuarios INNER JOIN endereco ON endereco.id_usuario = usuarios.id WHERE usuarios.id = :id_logado');
        	if(isset($_SESSION['logado'])){
	    	    $sql->bindValue(':id_logado', $_SESSION['logado']);
	    	    $sql->execute();
	        }        	

        	$sql = $this->pdo->prepare('DELETE FROM reserva WHERE id_usuario = :id_logado');
        	if(isset($_SESSION['logado'])){
	    	    $sql->bindValue(':id_logado', $_SESSION['logado']);
	    	    $sql->execute();
	        }
	    	
        }

    	?>
    	<script type="text/javascript">window.location.href="<?php echo BASE_URL; ?>lista"</script>
    	<?php
    }  

	public function pesquisar($texto){
		$dados = array(); 
        /*Preciso melhorar pesquisa*/
		$sql = $this->pdo->prepare("SELECT id, nome FROM usuarios WHERE nome LIKE :texto OR cpf LIKE :texto OR email = :texto");
		$sql->bindValue(':texto', "%".$texto."%");		
		$sql->execute(); 

		if($sql->rowCount() > 0){
			$dados = $sql->fetchAll();
			return $dados;
		} return $dados;

	}

	public function getPaciente($id){
        $dados = array();
		$sql = $this->pdo->prepare("SELECT usuarios.id, usuarios.nome, usuarios.idade, usuarios.sexo, usuarios.cpf, usuarios.email, usuarios.telefone, endereco.estado, endereco.cidade, endereco.cep, endereco.rua, endereco.numero FROM usuarios INNER JOIN endereco ON endereco.id_usuario = usuarios.id WHERE usuarios.id= :id");
		$sql->bindValue(':id', $id);
		$sql->execute();

		if($sql->rowCount() > 0){
			$dados = $sql->fetchAll();
			return $dados;
		} else{
			return $dados; 
		}


	}	

	public function recuperarSenha(){
        $sql = $this->pdo->prepare("SELECT id, email FROM usuarios WHERE email = :email");
        $sql->bindValue(':email', $this->email);
        $sql->execute();

        if($sql->rowCount() > 0){

            $sql = $sql->fetch();
            $id = $sql['id']; 

            $cod = md5(time().rand(0, 9999).rand(0, 9999));

            $sql = $this->pdo->prepare("INSERT INTO recuperar_senha SET id_usuario = :id_usuario, cod = :cod, tempo_cod = :tempo_cod");
            $sql->bindValue(':id_usuario', $id);
            $sql->bindValue(':cod', $cod);            
            $sql->bindValue(':tempo_cod', date('Y-m-d H:i', strtotime('+1 hours')));
            $sql->execute();

            $link = BASE_URL."redefinir?cod=".$cod;

            $assunto = "Redefinição de senha";

            $mensagem = "Olá, você solicitou uma alteração de senha? Clique no link para redefiní-la: ".$link."\r\n"." Caso contrário, ignore essa mensagem! Obrigado";

           

            $headers = "From: contato@clinica.com.br"."\r\n".
                       "X-Mailer: PHP/".phpversion();

                       echo $mensagem;

           mail($this->email, $assunto, $mensagem, $headers);

            return true; 
                

        } else {
            return false; 
        }
    }

    public function redefinirSenha($cod){

        $sql = $this->pdo->prepare("SELECT * FROM recuperar_senha WHERE cod = :cod AND used = 0 AND tempo_cod > NOW()");
        $sql->bindValue(':cod', $cod);              
        $sql->execute();

        if($sql->rowCount() > 0){
            $sql = $sql->fetch();

            $id = $sql['id_usuario']; 

            $sql = $this->pdo->prepare("UPDATE usuarios SET senha = md5(:senha) WHERE id = :id");
            $sql->bindValue(':senha', $this->senha);
            $sql->bindValue(':id', $id);
            $sql->execute();

           if(!empty($this->senha)){

                $sql = $this->pdo->prepare("UPDATE recuperar_senha SET used = 1 WHERE cod = :cod");
                $sql->bindValue(':cod', $cod);
                $sql->execute();                 
               
            }

            return true; 

        } else{
           return false;            
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


