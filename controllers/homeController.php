<?php 

class homeController extends controller{	
	
	public function index(){
		
		$dados = array();	
        
        $u = new Usuarios();               

        /*Paginação*/
        $inicio = 0;
        $btn = 3;

        $total_reg = $u->qtUsuarios();       
        
        if($total_reg > $btn){
        	$por_pagina = ceil($total_reg / $btn); 
        } else{
        	$por_pagina = 4;
        }

        if(isset($_GET['p']) && !empty($_GET['p'])){
        	$inicio = addslashes($_GET['p']);
        	$inicio = ($inicio - 1) * $por_pagina;
        }        

		$lista = $u->getUsuarios($inicio, $por_pagina);      

		$permissao = $u->permissoes(); 

		$dados = array(
			'lista' => $lista,
			'por_pagina' => $btn,
			'total_reg' => $total_reg,
			'permissao' => $permissao
			
		);
       
		$this->loadTemplate('home', $dados);
	}
		
}