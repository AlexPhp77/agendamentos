<?php 

class clienteController extends controller{

	public function index(){

		$dados = array();
		
		$u = new Usuarios();
		$f = new Funcionarios();
		$r = new Reservas(); 
       
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
			$sexo = addslashes($_POST['sexo']);
			$cpf = addslashes($_POST['cpf']);
			$email = addslashes($_POST['email']);
			$telefone = addslashes($_POST['telefone']);			
			$estado = addslashes($_POST['estado']);
			$cidade = addslashes($_POST['cidade']);
			$cep = addslashes($_POST['cep']);
			$rua = addslashes($_POST['rua']);
			$numero = addslashes($_POST['numero']);
			$id = addslashes($_GET['id']);            

			$u->infoAllEditar($nomecompleto, $idade, $sexo, $cpf, $email, $telefone, $estado, $cidade, $cep, $rua, $numero, $id);          
		}	

		if(isset($_GET['id_usuario']) && !empty($_GET['id_usuario'])){
			$id_usuario = addslashes($_GET['id_usuario']);
			$u->deletar($id_usuario);
		}	       

		if(isset($id) && !empty($id)){
			$dados = $u->getPaciente($id);
		} else{
			$id_usuario = addslashes($_POST['id_usuario']);
			$dados = $u->getPaciente($id_usuario);
			$u->deletar($id_usuario);
		}
        
        $msg = '';
        $msg2 = '';
        $msg3 = '';
		if(isset($_POST['data']) && !empty($_POST['data']) && !empty($_POST['doutor'])){
		   
            $data = addslashes($_POST['data']);
			$hora = addslashes($_POST['hora']); 
			$id_dentista = addslashes($_POST['doutor']);
			
			$data_atual = date('Y-m-d H:i');
			
			$m = date('m');
			$Y = date('Y');  		 
			$data_inicio = $Y."-".$m."-".$data." ".$hora;
			
			date_default_timezone_set('America/Sao_Paulo');
			
			if(date('Y-m-d H:i', strtotime($data_inicio)) >= $data_atual){				

				if($r->verificarDisponibilidade($data_inicio, $id_dentista) == false){
			        $msg2 = "Já existe um serviço marcado para esse horário. Por favor, escolha outro!";
			    } 

			    if($r->addReservas($id, $id_dentista, $data_inicio) == true){
					$msg3 = "Horário reservado com sucesso!";					
				}

			} else{
				$msg = "Hora inválida!";
			}
		}			
       
        foreach($dados as $dado){

        	$dados = array(
			'nome' => $dado['nome'],			
			'idade' => $dado['idade'],
			'sexo' => $dado['sexo'],			
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
			'permissao' => $permissoes = $u->permissoes(),
			'funcionarios' => $f->getFuncionarios()
			
		    );
        }	      
                  
		$this->loadTemplate('informacoes_cliente', $dados);		
	}
}