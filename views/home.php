
<?php /*Se SECRETÁRIO estiver logado acessa essa área*/
    if(isset($_SESSION['logadoFuncionario']) && !empty($_SESSION['logadoFuncionario']) && $permissao['permissoes'] == 'SECRETARIO'): ?>
<section class="homefrente" style="background-color: #000; min-height: 100vh;">
	<!-- Modal marcar horários -->
	<div class="modal fade" id="marcarhoras" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Adicionar horário personalizado</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">

	      	<form method="POST" action="<?php echo BASE_URL; ?>home/inserir_datas">
			  <div class="form-row">
			    <div class="col-md-12">
			      <label class="col-sm-12 col-form-label">Descrição
			            <input name="title" type="text" class="form-control" placeholder="Título">
			      </label>
			    </div>
			    <div class=" col-md-6">
			      <label class="col-sm-12 col-form-label">Hora início
			            <input name="start" type="datetime-local" class="form-control">
			      </label>
			    </div>
			    <div class=" col-md-6">
			      <label  class="col-sm-12 col-form-label">Hora fim
			            <input name="end" type="datetime-local" class="form-control" >
			      </label>
			    </div>
			    <div class=" col-md-6">
			      <label  class="col-sm-12 col-form-label">Cor			            

			            <input class="form-control" type="color" id="cores" name="cor" list="arcoIris" value="#FF0000">
						<datalist id="arcoIris">
						<option value="#FF0000">Vermelho</option>
						<option value="#FFA500">Laranja</option>						
						<option value="#008000">Verde</option>
						<option value="#000000">Preto</option>			
						</datalist>

			      </label>
			    </div>	

			    <div class="col-md-6">
                    <label class="col-sm-12 col-form-label">Pesquisar
				    	<input class="form-control" type="search" id="busca" name="busca"></br>

				    	<div class="teste">				    			
				    			<!--resultado busca ajax-->
				    	</div>					    	
			        </label>
			    </div>	

			   </div> 
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <button type="input" id="salvarTime" class="btn btn-dark">Salvar</button>
	      </div>
	      </form>   
	    </div>
	  </div>
	</div>

    <!-- Modal Inserir Users -->
	<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	      <h5 class="modal-title" id="exampleModalLongTitle">CADASTRAR</h5>
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	      </button>
	    </div>
	    <div class="modal-body">
	        <a class="nav-link" href="cadastro">
	        	<button class="btn btn-outline-info">Cliente</button>
	        </a>
	        <a class="nav-link" href="cadastro_funcionario">
	        	<button class="btn btn-outline-info">Funcionário</button>
	        </a>
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-outline-info" data-dismiss="modal">CANCELAR</button>       
	    </div>
	  </div>
	</div>
	</div>

	<div class="container bg-light" style="padding-top: 20px;"> 

		  
		    <div class='botoes d-flex'>

		    	 <!-- Button modal -->
			    <a href="<?php echo BASE_URL; ?>home">
			    	<button style="float: right;" type="button" class="btn btn-primary justify-content-end" data-toggle="modal">
			        <img width="90px" src='<?php echo BASE_URL; ?>assets/images/home.svg'>
			        </button> 
			    </a>

		    	<!-- Button modal -->
			    <a href="<?php echo BASE_URL; ?>lista">
			    	<button type="button" class="btn btn-primary" data-toggle="modal">
			        <img width="90px" src='<?php echo BASE_URL; ?>assets/images/lista.svg'>
			        </button> 
			    </a>

		    	<!-- Button modal -->
			    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
			       <img width="90px" src='<?php echo BASE_URL; ?>assets/images/add-paciente.svg'>
			    </button>

                <!-- Button modal OBS configurações em construção pagina
			    <a href="<?php //echo BASE_URL; ?>config">
			    	<button type="button" class="btn btn-primary" data-toggle="modal">
			        <img width="90px" src='<?php //echo BASE_URL; ?>assets/images/engrenagem.svg'>
			        </button> 
			    </a> -->

			    <!-- Button modal -->
			    <a href="<?php echo BASE_URL; ?>sair">
			    	<button style="float: right;" type="button" class="btn btn-primary justify-content-end" data-toggle="modal">
			        <img width="90px" src='<?php echo BASE_URL; ?>assets/images/exit.svg'>
			        </button> 
			    </a>

		    </div>
		    <hr/>

		    <div class="container">	  

		            <?php if($qtAvisos > 0): ?>
		    		  <div style="width: 32px; height: 32px; position: absolute; background-color: orange; margin-left: 0px;  padding: 3px; border-radius: 100%; text-align: center; color: #000; border: 0px;" >
			        	<?php echo ($qtAvisos > 0)? $qtAvisos:''; ?>
			          </div>
                    <?php endif; ?>  

                    <br/>
		    	
		    		<button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#esconder" aria-expanded="false" aria-controls="esconder">              

			        <img width="30px" src="<?php echo BASE_URL; ?>assets/images/falante.svg">
			        </button>	
			        <button class="btn btn-outline-primary">
			        	<a href="<?php echo BASE_URL; ?>./">
			        		<img width="30px" src="<?php echo BASE_URL; ?>assets/images/update.svg">
			        	</a>
			        </button>			        		    	    	
		    </div><br/>		   

		    <?php foreach($avisos as $aviso): ?>	
		   	
			<div class="container collapse" id="esconder">
				<div class="alert
                    <?php if($aviso['confirmado'] == 1){echo 'alert-success';}else{echo 'alert-dark'; } ?>
				    alert-dismissible fade show row" role="alert">
					<div class="col-sm">
						CLIENTE:
				        <a href="<?php echo BASE_URL; ?>cliente/?id=<?php echo $aviso['id_usuario']; ?>">
				        	<?php echo "</br>".$aviso['nome']; ?> 
				        </a>
				    </div>
				    <div class="col-sm">
				    	<?php echo "TELEFONE: </br>".$aviso['telefone']; ?>
				    </div>
				    <div class="col-sm">
				    	<?php echo "DIA E HORÁRIO DA RESERVA:<br/> ".date('d-m-Y H:i', strtotime($aviso['data_inicio']))." às ".date('H:i', strtotime($aviso['data_fim'])); ?>
				    </div>	
				     <div class="col-sm">
				     	BARBEIRO: <br/>
				     	<?php echo $aviso['doutor']; ?>				    
				    </div>	

				     <form method="POST">
				     	<input id="id_reserva" type="hidden" value="<?php echo $aviso['id'] ?>" name="id_reserva">
				     	<input type="hidden" value="<?php echo $aviso['id_usuario'] ?>" name="id_usuario">
				     	<button name="btn_confirmar" class="btn btn-light" type="submit" value="<?php echo ($aviso['confirmado'] == 1)? 0 : 1; ?>">
				     		<?php echo ($aviso['confirmado'] == 1)? 'OK' : 'CONFIRMAR'; ?>
				     	</button><br/><br/>

				     	 <!-- Button trigger modal -->
					    <button type="button" data-id2="<?php echo $aviso['id'] ?>" class="btn btn-danger btndanger" data-toggle="modal" data-target="#modaldelete">
					      Deletar
					    </button>				     	

				     </form>

				     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					</button>	    
			    </div>
			</div>

		    <?php endforeach; ?>

		      <!-- Modal -->
			  <div class="modal fade" id="modaldelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			    <div class="modal-dialog modal-dialog-centered" role="document">
			      <div class="modal-content">
			        <div class="modal-header">
			          <h5 class="modal-title" id="exampleModalLongTitle">DELETAR RESERVA</h5>
			          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			            <span aria-hidden="true">&times;</span>
			          </button>
			        </div>
			        <div class="modal-body">
			          Tem certeza que deseja excluir? 
			        </div>
			        <div class="modal-footer">
                    <form method="POST" action="<?php echo BASE_URL; ?>home/excluir_datas">
                     
                    	<input id="id2" type="hidden" value="" name="id_reserva">
				     	<input type="hidden" value="" name="id_usuario">
                     
			            <button type="button" class="btn btn-outline-info" data-dismiss="modal">CANCELAR</button>

			            <button type="submit" style="float: right; margin-left: 10px;" class="btn btn-danger">SIM</button>  
                    </form>			         
			        </div>
			      </div>
			    </div>
			  </div>		
              <hr/>
              <div style=" height: 100vh; " class="container">
              	<!--Calendário-->
			    <div id='calendar' class="responsive"></div>	              	
              </div>
            
   
<?php else: ?> 

<div class="container-fluid fundo">
	<!--<center class="imagem-fundo">
		<img height="auto" width="100%" class="img-fluid" alt="Imagem com dentista e paciente" src="<?php echo BASE_URL; ?>assets/images/fundo.jpg">	
	</center>-->
</div>

<div class="container carousel-fade " style="height: 100%">
	<div id="carouselExampleControls" class="carousel slide slide-textos " data-ride="carousel">
  <div class="carousel-inner ">
	<div class="carousel-item active">
	    <center style="color:#daa520;">
	    	<h2 class="display-2">Corte de cabelo</h2>
	        <p>R$ 30,00</p>	    	
	    </center> 
    </div>
    <div class="carousel-item">
        <center style="color:#daa520;">
	    	<h2 class="display-2">Sobrancelhas</h2>
	        <p>R$ 15,00</p>	    	
	    </center>
    </div>
    <div class="carousel-item">
       <center style="color:#daa520;">
	    	<h2 class="display-2">Barba</h2>
	        <p>R$ 30,00</p>	    	
	    </center> 
    </div>
    	

  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>	
</div>
  <section style="margin-top: 100px;">
  	<center>
  		<h1>Cadastre-se para agendar um horário.</h1></br>  		
  	</center>  
  </section>
  <section>

  	<center style="margin-top: 30px;">
  		  <a style="color:#daa520; text-decoration: none; font-size: 20px" href="<?php echo BASE_URL; ?>cadastrar">CADASTRAR-SE</a>
  	</center>

  	    <div class=" celular">
        <center style="color:#daa520;">
	    	<img width="200px" src="<?php echo BASE_URL; ?>assets/images/logo.png">  	
	    </center> 
        </div>  

  	   
		  <hr/>   

		    <?php if(!empty($aviso)): ?>   

			<?php if($aviso['aviso'] == true): ?>
			    <?php for($i=0; $i < count($aviso['horas']); $i++): ?>   
			    <?php if(isset($_GET['id']) && !empty($_GET['id'])){ $id=addslashes($_GET['id']); } ?> 
			    <div id="aviso-reserva" class="alert alert-success" role="alert">      
			    <button type="button" class="close" aria-label="Close"> 
			    <a href="<?php echo BASE_URL; ?>paciente/?id=<?php echo $id; ?>&id_reserva=<?php echo $aviso['horas'][$i]['id'] ?>">
			      <span value="excluir" input="submit" aria-hidden="true">&times;</span>        
			    </a>
			    </button>
			      <?php $datahora = date('d/m/Y \à\s H:i', strtotime($aviso['horas'][$i]['data_inicio'])); ?>
			        Esse usuário tem consulta marcada dia <?php echo $datahora; ?> com o doutor(a)
			        <?php echo $aviso['horas'][$i]['nome']; ?>
			       
			    </div>
			    <?php endfor; ?>
			<?php endif; ?>

			<?php endif; ?> 
  
  </section>
   
  


    <footer class="container-fluid fixed-bottom text-end">
      <div class="container">
        <div class="row">
          <div style="font-size: 13px" class="col-sm direitos">
            © 2020 Copyright <br/>
            Desenvolvido por <a class="text-light" href="http://www.Lalehub.com.br">Lalehub</a>
          </div>
          <div class="col-sm" >
            Contato: </br>
            (42) 99919-1167
          </div>
          <div class="col-sm">           
            Endereço: </br> 
            Av. Pres. Castelo Branco, 1023  </br>
            São Cristóvão, Guarapuava - PR </br>
            85065-230 </br>
          </div>
        </div>
      </div>      
    </footer> 
</section>
<?php endif; ?>    

  
