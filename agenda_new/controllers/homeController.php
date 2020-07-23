<?php 

class homeController extends controller{	
	
	public function index(){
		
		$dados = array();	
        
        $u = new Usuarios();   
        $f = new Funcionarios(); 
        $r = new Reservas(); 


        $r->deletarHorarios();      

        if(!empty($_POST['id_reserva']) && !empty($_POST['id_usuario'])){

            $id_usuario = addslashes($_POST['id_usuario']);
            $id_reserva = addslashes($_POST['id_reserva']);
            $btn_confirmar = '';
            if(isset($_POST['btn_confirmar'])){
                $btn_confirmar = addslashes($_POST['btn_confirmar']);
            }               
          
            $r->confirmarReserva($id_reserva, $id_usuario, $btn_confirmar);                  
        }

        if(!empty($_POST['btn_deletar'])){
            $id_reserva = addslashes($_POST['id_reserva']);
            $id_user = addslashes($_POST['btn_deletar']);
            $r->deletarReserva($id_user, $id_reserva);  
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

		//$permissao = $f->permissoes(); 

        $aviso_reservas = $r->avisoConsultas();

        $msg = '';
        $msg2 = '';
        $msg3 = '';
        if(isset($_POST['data']) && !empty($_POST['data']) && !empty($_POST['doutor'])){
           
            $data = addslashes($_POST['data']);
            $hora = addslashes($_POST['hora']); 
            $id_dentista = addslashes($_POST['doutor']);
            $id = addslashes($_POST['paciente_id']);

            date_default_timezone_set('America/Sao_Paulo');
            
            $data_atual = date('Y-m-d H:i');

            $data_inicio = $data." ".$hora;
            
            if(date('Y-m-d H:i', strtotime($data_inicio)) >= date('Y-m-d H:i', strtotime($data_atual))){              

                if($r->verificarDisponibilidade($data_inicio, $id_dentista) == false){
                    $msg2 = "Já existe consulta marcada para esse horário!";
                } 

                if($r->addReservas($id, $id_dentista, $data_inicio) == true){
                    $msg3 = "Consulta marcada com sucesso!";                    
                }

            } else{
                $msg = "Hora inválida!";
            }
        }       
       

		$dados = array(
			'lista' => $lista,
			'por_pagina' => $btn,
			'total_reg' => $total_reg,
			'permissao' => $f->permissoes(),
			'btn' => $btn,
            'avisos' => $aviso_reservas,
            'temReserva' => $r->verificarReservaDia(),          
            'funcionarios' => $f->getFuncionarios(),
            'pacientes' => $u->getPacientes(),
            'm' => $msg,    
            'm2'=> $msg2,
            'm3' => $msg3,           
           
            
			
		);
             
        $this->loadTemplate('home', $dados);
	}
	
    public function listar_datas(){

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

                if($dado['all_day'] == 1){
                    $start  = date('Y-m-d', strtotime($dado['data_inicio']));                
                    $end =  date('Y-m-d', strtotime($dado['data_fim'])); 
                } else{
                    $start  = date('Y-m-d H:i', strtotime($dado['data_inicio']));               
                    $end =  date('Y-m-d H:i', strtotime($dado['data_fim']));
                }
                

                $dados[] = array(
                'id' => $dado['id'],
                'title' => 'teste', 
                'rendering' => 'background',
                'color' => $dado['cor'],    
                'start' => $start,             
                'end' =>  $end, 

                
            );
            }
            
            echo json_encode($dados); 
            
        } 
    }	

    public function inserir_datas(){


try {
    $pdo = new PDO("mysql:dbname=agenda;host=localhost", "root", "");   
} catch (PDOException $e) {
    echo "Error: ".$e->getMessage();    
}



     //if(isset($_POST['title'])){
        date_default_timezone_set('America/Sao_Paulo');       
      
        if($_POST['allDay'] == true){
           $allDay = 1;
        } else{
           $allDay = 0; 
        }

        $start = date('Y-m-d H:i', strtotime($_POST['start']));
        $end = date('Y-m-d H:i', strtotime($_POST['end']));
       // echo $start."<br/>";
        //echo $end."<br/>";  
      

        $sql = $pdo->prepare("INSERT INTO reserva SET data_inicio = :data_inicio, data_fim = :data_fim, all_day = :allDay");
        $sql->bindValue(':data_inicio', $start);
        $sql->bindValue(':data_fim', $end);
        $sql->bindValue(':allDay', $allDay);
        $sql->execute();        


    // }
        
    }

    public function atualizar_datas(){


try {
    $pdo = new PDO("mysql:dbname=agenda;host=localhost", "root", "");   
} catch (PDOException $e) {
    echo "Error: ".$e->getMessage();    
}



     if(isset($_POST['title'])){
        date_default_timezone_set('America/Sao_Paulo'); 
        $title = $_POST['title'];
      
        $id = $_POST['id'];
        $start = date('Y-m-d H:i', strtotime($_POST['start']));
        $end = date('Y-m-d H:i', strtotime($_POST['end']));
        echo $start."<br/>";
        echo $end; 

           $sql = $pdo->prepare("UPDATE reserva SET data_inicio = :data_inicio, data_fim = :data_fim WHERE id = :id");
        $sql->bindValue(':id', $id);   
        $sql->bindValue(':data_inicio', $start);
        $sql->bindValue(':data_fim', $end);
        $sql->execute();        


     }
        
        
    }
}