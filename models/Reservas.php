<?php

class Reservas extends Conexao{

	/*Refazendo partes do sistema*/
	public function listarDatas(){

		$sql = $this->pdo->query("SELECT * FROM reserva");  
        $dados = array();

        if($sql->rowCount() > 0){
            $dados = $sql->fetchAll();
            foreach ($dados as $dado) {

                if($dado['all_day'] == 1){
                    $start  = date('Y-m-d', strtotime($dado['data_inicio']));                
                    $end =  date('Y-m-d', strtotime($dado['data_fim'])); 
                } else{
                    $start  = date('Y-m-d H:i', strtotime($dado['data_inicio']));               
                    $end =  date('Y-m-d H:i', strtotime($dado['data_fim']));
                }                

                $dados[] = array(
                'id' => $dado['id'],
                'title' => $dado['titulo'], 
                'display' => 'auto', /*opção background*/
                'color' => $dado['cor'],    
                'start' => $start,             
                'end' =>  $end,                 
                );
            }           
            echo json_encode($dados); 
        } 
	}

	public function inserirDatas(){

		if(isset($_POST['title'])){

			 $title = $_POST['title'];
        $start = date('Y-m-d H:i', strtotime($_POST['start']));
        $end = date('Y-m-d H:i', strtotime($_POST['end']));

        date_default_timezone_set('America/Sao_Paulo'); 

        if(!empty($_POST['allDay'])){
               $allDay = $_POST['allDay'];  
            if($allDay === 'true'){
                $allDay = 1;
            } elseif($allDay === 'false'){             
                $allDay = 0;
            }
        } else{


        	$start = DateTime::createFromFormat('Y-m-d H:i', $start);
        	$end = DateTime::createFromFormat('Y-m-d H:i', $end);

          //  $start = new DateTime(date($start));
          //  $end = new DateTime(date($end));


            $start->format('Y-m-d H:i');
            $end->format('Y-m-d H:i');

            $interval = $start->diff($end);

            //echo $interval->days;
            //	exit; 

           // print_r($interval);

            
           if($interval->days > '0'){

                $allDay = 1;   
            } 
       }

        if(!empty($_POST['cor'])){
            $cor = $_POST['cor'];
        } else{
            $cor = NULL;
        }

      
    }

    // echo $start."<br/>";
    // echo $end."<br/>";  
    // echo $allDay; 
    //echo  $title;
    //var_dump($start);

    $sql = $this->pdo->prepare("INSERT INTO reserva SET titulo = :titulo, data_inicio = :data_inicio, data_fim = :data_fim, all_day = :allDay, cor = :cor");
    $sql->bindValue(':titulo', $title);
    if(is_object($start)){
    	$sql->bindValue(':data_inicio',  $start->format('Y-m-d H:i'));
    	$sql->bindValue(':data_fim',  $end->format('Y-m-d H:i'));
    } else {
        $sql->bindValue(':data_inicio', $start);
        $sql->bindValue(':data_fim', $end);
    }

    $sql->bindValue(':cor', $cor);
    $sql->bindValue(':allDay', $allDay);
    $sql->execute();        

    header('Location: '.BASE_URL); 
	}

	public function atualizarDatas(){

		// if(isset($_POST['title'])){

	    date_default_timezone_set('America/Sao_Paulo'); 
	    $title = $_POST['title'];
	  
	    $id = $_POST['id'];
	    $start = date('Y-m-d H:i', strtotime($_POST['start']));
	    $end = date('Y-m-d H:i', strtotime($_POST['end']));

	    $sql = $this->pdo->prepare("UPDATE reserva SET data_inicio = :data_inicio, data_fim = :data_fim WHERE id = :id");
	    $sql->bindValue(':id', $id);   
	    $sql->bindValue(':data_inicio', $start);
	    $sql->bindValue(':data_fim', $end);
	    $sql->execute(); 
	    
	    // }       
	}

	public function excluirDatas(){

		$id = $_POST['id'];
	      
	    //echo $id."<br/>";              

	    $sql = $this->pdo->prepare("DELETE FROM reserva WHERE id = :id");
	    $sql->bindValue(':id', $id);        
	    $sql->execute();        
	}

    /**************************************************************/
	public function getReservas(){

		$dados = array();

		/*SELECT reserva.data_inicio, reserva.data_fim, usuarios.nome FROM reserva INNER JOIN usuarios ON usuarios.id = reserva.id_usuario*/

		$sql = $this->pdo->query("SELECT reserva.data_inicio, reserva.data_fim, usuarios.nome FROM reserva INNER JOIN usuarios ON usuarios.id = reserva.id_usuario");

		if($sql->rowCount() > 0){
			$dados = $sql->fetchAll();
			return $dados; 
		} return $dados; 
	}

	public function deletarReserva($id, $id_reserva){ 

    	$sql = $this->pdo->prepare('DELETE FROM reserva WHERE id_usuario = :id_usuario AND id = :id');    	
    	$sql->bindValue(':id', $id_reserva);
    	$sql->bindValue(':id_usuario', $id);
    	$sql->execute();

        echo "<meta http-equiv='refresh'>";
    }

	public function pesquisar($texto){
		$dados = array(); 
        /*Preciso melhorar pesquisa*/
		$sql = $this->pdo->prepare("SELECT usuarios.nome, reserva.data_inicio, reserva.data_fim FROM usuarios INNER JOIN reserva  ON usuarios.id = reserva.id_usuario WHERE usuarios.nome LIKE :texto OR reserva.data_inicio = :texto");
		$sql->bindValue(':texto', "%".$texto."%");		
		$sql->execute(); 

		if($sql->rowCount() > 0){
			$dados = $sql->fetchAll();
			return $dados;
		} return $dados;

	}

	public function verificarDisponibilidade($horario, $id_dentista){

		date_default_timezone_set('America/Sao_Paulo');

		$sql = $this->pdo->prepare("SELECT * FROM reserva WHERE 
			(NOT (data_inicio > :data_fim OR data_fim < :data_inicio)) AND id_dentista = :id_dentista");
		$sql->bindValue(':id_dentista', $id_dentista);
		$sql->bindValue(':data_inicio', date('Y-m-d H:i', strtotime($horario)));		
		$sql->bindValue(':data_fim', date('Y-m-d H:i', strtotime($horario.'+59 minutes')));
		$sql->execute();

		if($sql->rowCount() > 0){
			return false;
		} else{
			return true; 
		}
	}

	public function verificarReservaDia(){
		$dados = array();				

		$sql = $this->pdo->query("SELECT id_usuario, data_inicio, data_fim FROM reserva GROUP BY id_dentista ORDER BY cast(data_inicio as date) ASC");

		if($sql->rowCount() > 0){
			$dados = $sql->fetchAll();
			foreach ($dados as $dado) {
				date_parse_from_format('Y-m-d', $dado['data_inicio']);
				return $dados;
			}			
		} 
		return $dados;		
	}

	

	public function qtReservasExistem(){ 
		$dados = array();

		$sql = $this->pdo->query("SELECT COUNT(*) as totalReserva, data_inicio FROM reserva GROUP BY cast(data_inicio as date)");
		$dados = $sql->fetchAll();
		return $dados;
	}  

	public function addReservas($id, $id_dentista, $data_inicio){	
	
	   	if($this->verificarDisponibilidade($data_inicio, $id_dentista)){

		$sql = $this->pdo->prepare("INSERT reserva SET data_inicio = :data_inicio, data_fim = :data_fim, id_usuario = :id_usuario, id_dentista = :id_dentista");
		$sql->bindValue(':id_usuario', $id);
		$sql->bindValue(':id_dentista', $id_dentista);
		$sql->bindValue(':data_inicio', $data_inicio);		
		$sql->bindValue(':data_fim', date('Y-m-d H:i', strtotime($data_inicio.'+59 minutes')));
		$sql->execute();	

		return true; 
		
		} 
	}

	public function temReserva($id){
        $dados = array();
		$sql = $this->pdo->prepare("SELECT reserva.*, funcionarios.nome FROM reserva LEFT JOIN funcionarios ON funcionarios.id = reserva.id_dentista WHERE id_usuario = :id ORDER BY data_inicio ASC");
		$sql->bindValue(':id', $id);
		$sql->execute(); 

		if($sql->rowCount() > 0){
			$dados = $sql->fetchAll();
			$dados = array(
			    'horas' => $dados, 				
				'aviso' => true 
			);
			
		} else{
			return false; 
		}
		return $dados; 
	}

	public function avisoConsultas(){
		$dados = array();

		date_default_timezone_set('America/Sao_Paulo');	
		$data_atual = date('Y-m-d H:i');			

		$sql = $this->pdo->prepare("SELECT reserva.id, reserva.id_usuario, reserva.data_inicio, reserva.data_fim, reserva.confirmado, usuarios.nome, usuarios.telefone, (funcionarios.nome) as doutor FROM reserva  INNER JOIN usuarios ON reserva.id_usuario = usuarios.id LEFT JOIN funcionarios ON reserva.id_dentista = funcionarios.id WHERE (NOT (data_inicio > :data_atual)) ORDER BY reserva.data_inicio ASC");
		$sql->bindValue(':data_atual', date('Y-m-d H:i', strtotime($data_atual.'+1 day +4 hours')));
		$sql->execute();
		
		if($sql->rowCount() > 0 ){
			return $dados = $sql->fetchAll();

		} else{
			return $dados; 
		}
	}

	public function deletarHorarios(){

		date_default_timezone_set('America/Sao_Paulo');	
		$data_atual = date('Y-m-d H:i');

		$sql = $this->pdo->query("DELETE FROM reserva WHERE data_inicio < '$data_atual'"); 

    	return true; 
	}

	public function confirmarReserva($id_reserva, $id_usuario, $btn_confirmar){

		$sql = $this->pdo->prepare("UPDATE reserva SET confirmado = :btn_confirmar WHERE id_usuario = :id_usuario AND id = :id_reserva");
		$sql->bindValue(':btn_confirmar', $btn_confirmar);
		$sql->bindValue(':id_reserva', $id_reserva);
		$sql->bindValue(':id_usuario', $id_usuario);
		$sql->execute(); 

		return true; 
	}

	public function allHorariosDia($data_inicio){
		$dados = array();	

		$sql = $this->pdo->query("SELECT reserva.data_inicio, reserva.data_fim, funcionarios.nome as dentista, usuarios.nome as paciente FROM reserva LEFT JOIN funcionarios ON funcionarios.id = reserva.id_dentista LEFT JOIN usuarios ON usuarios.id = reserva.id_usuario where DATE(data_inicio) = DATE('$data_inicio') ORDER BY reserva.data_inicio ASC");
		//$sql->bindValue(':data_inicio', date('Y-m-d', strtotime($data_inicio)));
		//$sql->execute();

		if($sql->rowCount() > 0){
			$dados = $sql->fetchAll();				
		} 

		return $dados;		
	}
}