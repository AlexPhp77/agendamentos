<?php

class Reservas extends Conexao{

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

    	return true; 
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

	public function verificarDisponibilidade($horario){

		$sql = $this->pdo->prepare("SELECT * FROM reserva WHERE 
			(NOT (data_inicio > :data_fim OR data_fim < :data_inicio))");
		$sql->bindValue(':data_inicio', $horario);		
		$sql->bindValue(':data_fim', date('Y-m-d H:i', strtotime($horario.'+1 hours')));
		$sql->execute();

		if($sql->rowCount() > 0){
			return false;
		} else{
			return true; 
		}
	}

	public function addReservas($id, $data_inicio){	
	
	   	if($this->verificarDisponibilidade($data_inicio)){

		$sql = $this->pdo->prepare("INSERT reserva SET data_inicio = :data_inicio, data_fim = :data_fim, id_usuario = :id_usuario");
		$sql->bindValue(':id_usuario', $id);
		$sql->bindValue(':data_inicio', $data_inicio);		
		$sql->bindValue(':data_fim', date('Y-m-d H:i', strtotime($data_inicio.'+59 minutes')));
		$sql->execute();	

		return true; 

		?>
        <script type="text/javascript">document.location.reload(true);</script>
		<?php
		
		} 
	}

	public function temReserva($id){

		$sql = $this->pdo->prepare("SELECT * FROM reserva WHERE id_usuario = :id ORDER BY data_inicio ASC");
		$sql->bindValue(':id', $id);
		$sql->execute(); 

		if($sql->rowCount() > 0){
			$dados = $sql->fetchAll();
			return $dados = array(
			    'horas' => $dados, 				
				'aviso' => true 
			);
			
		} else{
			return false; 
		}
	}
}