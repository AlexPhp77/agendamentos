<?php 

class User{

	public function getUsers(){

		try {
		$pdo = new PDO("mysql:dbname=agenda;host=localhost", "root", "");
		
		} catch (PDOException $e) {
			echo "ERROR: ".$e->getMessage();
		}


		$dados = array();

		$sql = $pdo->query("SELECT nome,idade,sexo,cpf,email, telefone FROM usuarios ORDER BY nome ASC");   

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
}