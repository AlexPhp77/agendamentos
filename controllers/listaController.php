<?php 

class listaController extends controller{	
	
	public function index(){
		
        $dados = array();

        $get = new Usuarios();

      

       $itens = $get->getPacientes();

       foreach($itens as $item){
        //Cria o array de informações a serem retornadas para o Javascript
		$dados = array(
			"draw" => $item['id'],//para cada requisição é enviado um número como parâmetro
			"recordsTotal" => 6,  //Quantidade de registros que há no banco de dados
			"recordsFiltered" => 10, //Total de registros quando houver pesquisa
			"data" => $get->getPacientes()//Array de dados completo dos dados retornados da tabela 
		);
	    }

		$dados[] = json_encode($dados); 

             
        $this->loadTemplate('lista', $dados);
	}

}