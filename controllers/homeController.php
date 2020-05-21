<?php 

class homeController extends controller{	
	
	public function index(){
		
		$dados = array();	
        
        $u = new Usuarios();               

        /*Paginação*/
        $inicio = 0;
        $btn = 3;

        $total_reg = $u->qtUsuarios();       
        $por_pagina = ceil($total_reg / $btn); 

        if(isset($_GET['p']) && !empty($_GET['p'])){
        	$inicio = addslashes($_GET['p']);
        	$inicio = ($inicio - 1) * $por_pagina;
        }        

		$lista = $u->getUsuarios($inicio, $por_pagina);

		$dados = array(
			'lista' => $lista,
			'por_pagina' => $btn
			
		);
       
		$this->loadTemplate('home', $dados);
	}
		
}