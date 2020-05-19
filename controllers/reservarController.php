<?php 

class reservarController extends controller{

	public function index(){

		$dados = array();	

		$r = new Reservas();		

		if(isset($_POST['data']) && !empty($_POST['data'])){
            
            $id = addslashes($_GET['id']); 
            $data = addslashes($_POST['data']);
			$hora = addslashes($_POST['hora']); 

			$m = date('m');
			$Y = date('Y');  		 
			$data_inicio = $Y."-".$m."-".$data." ".$hora;
			
			date_default_timezone_set('America/Sao_Paulo'); 
			$data_atual = date('Y-m-d H:i');
           
			if($data_inicio >= $data_atual){
				$r->addReservas($id, $data_inicio);
			} 		
		}	
		
		$this->loadTemplate('adicionar_reserva', $dados);	
	}
}



