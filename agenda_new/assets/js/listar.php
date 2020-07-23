<?php 

try {
	$pdo = new PDO("mysql:dbname=agenda;host=localhost", "root", "");	
} catch (PDOException $e) {
	echo "Error: ".$e->getMessage();	
}



        $sql = $pdo->query("SELECT * FROM reserva");
		
		

		$dados = array();

		if($sql->rowCount() > 0){
			$dados = $sql->fetchAll();

			foreach ($dados as $dado) {
				$dados[] = array(
				'id' => $dado['id'],
				'title' => 'teste',	
				'color' => $dado['cor'],	
			    'start' => $dado['data_inicio'], 				
				'end' => $dado['data_fim'],
			);
			}
			
			echo json_encode($dados); 
			
		} 