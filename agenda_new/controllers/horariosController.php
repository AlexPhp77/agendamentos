<?php 

class horariosController extends controller{	
	
	public function index(){
		
		$dados = array();
       
        $u = new Usuarios();   
        $f = new Funcionarios(); 
        $r = new Reservas(); 

        if(isset($_GET['data']) && !empty($_GET['data'])){
            $data = addslashes($_GET['data']);

            $r->allHorariosDia($data);
        } 


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
            'horarios' => $r->allHorariosDia($data),
            'm' => $msg,    
            'm2'=> $msg2,
            'm3' => $msg3,
            'funcionarios' => $f->getFuncionarios(),
            'pacientes' => $u->getPacientes()

        );
             
        $this->loadTemplate('horarios', $dados);
	}		
}