<?php 

class usuarioController extends controller{

	public function index(){

		$dados = array();
		
		$u = new Usuarios();
		$r = new Reservas(); 	


		$permissoes = $u->permissoes();	
        
		
		if(isset($_SESSION['logado']) && !empty($_SESSION['logado'])){ 
			$id = $_SESSION['logado'];
			$aviso = $r->temReserva($id);
		}


		    		
       
		if(!empty($_POST['nome']) && !empty($_POST['cpf'])){

			$nomecompleto = addslashes($_POST['nome']);			
			$idade = addslashes($_POST['idade']);
			$cpf = addslashes($_POST['cpf']);
			$email = addslashes($_POST['email']);
			$telefone = addslashes($_POST['telefone']);			
			$estado = addslashes($_POST['estado']);
			$cidade = addslashes($_POST['cidade']);
			$cep = addslashes($_POST['cep']);
			$rua = addslashes($_POST['rua']);
			$numero = addslashes($_POST['numero']);
			$id = $id;           

			$u->infoAllEditar($nomecompleto, $idade, $cpf, $email, $telefone, $estado, $cidade, $cep, $rua, $numero, $id);          
		}		       

		if(isset($id) && !empty($id)){
			$dados = $u->getPaciente($id);
			
		} else{
			if(!empty($_GET['id_usuario']) && isset($_SESSION['id_usuario'])){
			    $id_usuario = addslashes($_GET['id_usuario']);		    
			$dados = $u->getPaciente($id_usuario);
			$u->deletar($id_usuario);
			unset($_SESSION['logado']);
		    }
		}
        
        $msg = '';
        $msg2 = '';
        $msg3 = '';
		if(isset($_POST['data']) && !empty($_POST['data'])){
		   
            $data = addslashes($_POST['data']);
			$hora = addslashes($_POST['hora']);
			
			date_default_timezone_set('America/Sao_Paulo');

			$m = date('m');
			$Y = date('Y');  		 
			$data_inicio = $Y."-".$m."-".$data." ".$hora;
		 
			$data_atual = date('Y-m-d H:i');
		  
           
			if(date('Y-m-d H:i', strtotime($data_inicio)) >= $data_atual){		

				if($false = $r->verificarDisponibilidade($data_inicio) == false){
			        $msg2 = "Já existe consulta marcada para esse horário!";
			    } 

			    if($r->addReservas($id, $data_inicio) == true){
					$msg3 = "Consulta marcada com sucesso!";					
				}

			} else{
				$msg = "Hora inválida!";
			}
		}		

		if(isset($_GET['id_reserva']) && !empty($_GET['id_reserva'])){
		    $id_reserva = addslashes($_GET['id_reserva']);

		    if($r->deletarReserva($id, $id_reserva)){
		       echo "<meta http-equiv='refresh'>";
		    }
		}	
       
        foreach($dados as $dado){

        	$dados = array(
			'nome' => $dado['nome'],			
			'idade' => $dado['idade'],
			'cpf' => $dado['cpf'],
			'email' => $dado['email'],
			'telefone' => $dado['telefone'],
			'estado' => $dado['estado'],
			'cidade' => $dado['cidade'],
			'cep' => $dado['cep'],
			'rua' => $dado['rua'],
			'numero' => $dado['numero'],
			'aviso' => $aviso,	
			'm' => $msg,	
			'm2'=> $msg2,
			'm3' => $msg3,
			'permissoes' => $permissoes['permissoes']		
			
		    );
        }	                
		$this->loadTemplate('usuario_area', $dados);		
	}
}