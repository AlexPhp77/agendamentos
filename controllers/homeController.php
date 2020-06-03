<?php 

class homeController extends controller{	
	
	public function index(){
		
		$dados = array();	
        
        $u = new Usuarios();   
        $r = new Reservas(); 

        $r->deletarHorarios();      

        if(isset($_POST['id_reserva']) && !empty($_POST['id_reserva'])){

                $id_usuario = addslashes($_POST['id_usuario']);
                $id_reserva = addslashes($_POST['id_reserva']);
                $btn_confirmar = addslashes($_POST['btn_confirmar']);

                $r->confirmarReserva($id_reserva, $id_usuario, $btn_confirmar);     
        }

        /*Paginação*/
        $inicio = 0; 
        $btn = 1;       

        $total_reg = $u->qtUsuarios(); 
       
        if($total_reg >= 20){
        	$por_pagina = ceil($total_reg / 2); 
        } elseif ($total_reg >= 50) {
        	$por_pagina = ceil($total_reg / 5);         	
        } elseif ($total_reg >= 100) {
        	$por_pagina = ceil($total_reg / 10);         	
        } elseif ($total_reg >= 500) {
        	$por_pagina = ceil($total_reg / 50);         	
        } elseif ($total_reg >= 1000) {
        	$por_pagina = ceil($total_reg / 100);         	
        } else{
        	$por_pagina = ceil($total_reg / $btn);   
        }        

        if(isset($_GET['p']) && !empty($_GET['p'])){
        	$inicio = addslashes($_GET['p']);
        	$inicio = ($inicio - 1) * $por_pagina;
        }        

		$lista = $u->getUsuarios($inicio, $por_pagina);      

		$permissao = $u->permissoes(); 

        $aviso_reservas = $r->avisoConsultas(); 

		$dados = array(
			'lista' => $lista,
			'por_pagina' => $btn,
			'total_reg' => $total_reg,
			'permissao' => $permissao,
			'btn' => $btn,
            'avisos' => $aviso_reservas
            
			
		);

        $this->loadTemplate('home', $dados);
	}
		
}