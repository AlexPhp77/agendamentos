<?php 

class redefinirController extends controller{

	public function index(){

		$dados = array();
		$u = new Usuarios();
        
        $msg = '';
        $msg2 = '';
        if($cod = filter_input(INPUT_GET, 'cod')){
			if($u->redefinirSenha($cod) == false){
				
               $msg = "Link inválido ou expirado!"; 

		    } else{
		    	$msg2 = "Link para redefinição de senha válido!";
		    }

	    }
        
        if($senha = filter_input(INPUT_POST, 'senha')){
        	$senha2 = filter_input(INPUT_POST, 'senha2');
        	if($senha == $senha2){
	        	if($u->setSenha($senha) == false){
	        		$msg = "Sua senha deve ter 8 ou mais caracteres!";	        		
	        	} else{
	        		$u->setSenha($senha);
	        		if($u->redefinirSenha($cod)){
	        		    ?>
                        <script type="text/javascript">
                        	alert("Senha alterada com sucesso!");
                        	window.location.href="<?php echo BASE_URL; ?>login";
                        </script>
	        		    <?php     		    
	        		}   		
	        	}

        	} else{
        		$msg = "As senhas não conferem! Por favor, digite novamente.";
        	}
	    }
	            
        $dados = array(
        	'm' => $msg,
        	'm2' => $msg2,
        	'codigo' => $u->redefinirSenha($cod)
        ); 

		$this->loadTemplate('redefinir', $dados); 
	}
}