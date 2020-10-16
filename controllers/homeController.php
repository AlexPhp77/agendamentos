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
            
            $data_atual = date('Y-m-d H:i');
            
            $m = date('m');
            $Y = date('Y');          
            $data_inicio = $Y."-".$m."-".$data." ".$hora;
            
            date_default_timezone_set('America/Sao_Paulo');
            
            if(date('Y-m-d H:i', strtotime($data_inicio)) >= $data_atual){              

                if($r->verificarDisponibilidade($data_inicio, $id_dentista) == false){
                    $msg2 = "Já existe um serviço marcado para esse horário. Por favor, escolha outro!";
                } 

                if($r->addReservas($id, $id_dentista, $data_inicio) == true){
                    $msg3 = "Horário reservado com sucesso!";                   
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
            'qtAvisos' =>  $r->getqtavisos()          
           
            
			
		);
             
        $this->loadTemplate('home', $dados);
	}

    public function listar_datas(){

        $listar = new Reservas();
        $listar->listarDatas();
      
    }
    public function inserir_datas(){

        $inserir = new Reservas();
        $inserir->inserirDatas();
    }   

    public function atualizar_datas(){

        $atualizar = new Reservas();
        $atualizar->atualizarDatas();  
        
    }

    public function excluir_datas(){

        $excluir = new Reservas();
        $excluir->excluirDatas();       
    }   
}