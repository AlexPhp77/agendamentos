<?php 
require "define.php";

class Conexao{

	protected $pdo; 

	public function __construct(){

		$config = array();

		if(MEIO == 'developer'){
			$config['dbname'] = 'agendamento_pacientes';
			$config['host'] = 'localhost';
			$config['dbuser'] = 'root';
			$config['dbpass'] = '';
			
		} else{			
			$config['dbname'] = 'lalehu09_agenda';
			$config['host'] = 'localhost';
			$config['dbuser'] = 'lalehu09';
			$config['dbpass'] = '@fifafut92f';			
		}

		try{
	        $this->pdo = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'].";charset=utf8", $config['dbuser'], $config['dbpass']); 
		} catch(PDOException $e){
			echo "Erro conexão: ".$e->getMessage();
			exit;
		}
	}
}


