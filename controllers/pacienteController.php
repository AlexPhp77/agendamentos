<?php 

class pacienteController extends controller{

	public function index(){

		$dados = array();
		
		$u = new Usuarios();
		$r = new Reservas(); 

		if(isset($_GET['id']) && !empty($_GET['id']) && isset($_POST['excluir'])){
		    $id_reserva = addslashes($_GET['id']);			
			$r->deletarReserva($id_reserva);
		}

		$id = '';
		if(isset($_GET['id']) && !empty($_GET['id'])){
			$id = addslashes($_GET['id']);
		}

		if(isset($_GET['id_reserva']) && !empty($_GET['id_reserva'])){
		    $id_reserva = addslashes($_GET['id_reserva']);		   		
		    $r->deletarReserva($id, $id_reserva);
		}

		$aviso = $r->temReserva($id);     		
       
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
			$id = addslashes($_GET['id']);            

			$u->infoAllEditar($nomecompleto, $idade, $cpf, $email, $telefone, $estado, $cidade, $cep, $rua, $numero, $id);          
		}		       

		if(isset($id) && !empty($id)){
			$dados = $u->getPaciente($id);
		} else{
			$id_usuario = addslashes($_GET['id_usuario']);
			$dados = $u->getPaciente($id_usuario);
			$u->deletar($id_usuario);
		}
        
        $msg = '';
		if(isset($_POST['data']) && !empty($_POST['data'])){
		   
            $data = addslashes($_POST['data']);
			$hora = addslashes($_POST['hora']); 

			$m = date('m');
			$Y = date('Y');  		 
			$data_inicio = $Y."-".$m."-".$data." ".$hora;
			
			date_default_timezone_set('America/Sao_Paulo'); 
			$data_atual = date('Y-m-d H:i'); 
			print_r($data_inicio);                
           
			if($data_inicio >= $data_atual){
				$r->addReservas($id, $data_inicio);
			} else{
				$msg = "Hora inválida!";
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
			'm' => $msg			
			
		    );
        }	                
		$this->loadTemplate('informacoes_paciente', $dados);		
	}
}