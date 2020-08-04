
<?php /*Se SECRETÁRIO estiver logado acessa essa área*/
    if(isset($_SESSION['logadoFuncionario']) && !empty($_SESSION['logadoFuncionario']) && $permissao['permissoes'] == 'SECRETARIO'): ?>

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
			      <label class="col-sm-12 col-form-label">Título
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
			   </div> 
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <button type="input" id="salvarTime" class="btn btn-primary">Salvar</button>
	      </div>
	      </form>   
	    </div>
	  </div>
	</div>

    <!-- Modal Inserir Users -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
	        	<button class="btn btn-primary">Paciente</button>
	        </a>
	        <a class="nav-link" href="cadastro_funcionario">
	        	<button class="btn btn-primary">Funcionário</button>
	        </a>
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-info" data-dismiss="modal">CANCELAR</button>       
	    </div>
	  </div>
	</div>
	</div>

	<div class="container"> 

		    <hr/>
		    <div class='botoes d-flex bd-highlight justify-content-end'>

		    	<!-- Button modal -->
			    <a href="<?php echo BASE_URL; ?>lista">
			    	<button type="button" class="btn btn-primary" data-toggle="modal">
			        <img width="90px" src='<?php echo BASE_URL; ?>assets/images/lista.svg'>
			        </button> 
			    </a>

		    	<!-- Button modal -->
			    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
			       <img width="90px" src='<?php echo BASE_URL; ?>assets/images/add-paciente.svg'>
			    </button>

                <!-- Button modal -->
			    <a href="<?php echo BASE_URL; ?>config">
			    	<button type="button" class="btn btn-primary" data-toggle="modal">
			        <img width="90px" src='<?php echo BASE_URL; ?>assets/images/engrenagem.svg'>
			        </button> 
			    </a>

		    </div>
		    <hr/>

		    <div class="container">
		    	
		    		<button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#esconder" aria-expanded="false" aria-controls="esconder">
			        Mostrar avisos 
			        </button>	
		    	    	
		    </div><br/>		   

		    <?php foreach($avisos as $aviso): ?>	
		   	
			<div class="container collapse" id="esconder">
				<div class="alert
                    <?php if($aviso['confirmado'] == 1){echo 'alert-success';}else{echo 'alert-primary'; } ?>
				    alert-dismissible fade show row" role="alert">
					<div class="col-sm">
						PACIENTE:
				        <a href="<?php echo BASE_URL; ?>paciente/?id=<?php echo $aviso['id_usuario']; ?>">
				        	<?php echo "</br>".$aviso['nome']; ?> 
				        </a>
				    </div>
				    <div class="col-sm">
				    	<?php echo "TELEFONE: </br>".$aviso['telefone']; ?>
				    </div>
				    <div class="col-sm">
				    	<?php echo "DIA E HORÁRIO DA CONSULTA:<br/> ".date('d-m-Y H:i', strtotime($aviso['data_inicio']))." às ".date('H:i', strtotime($aviso['data_fim'])); ?>
				    </div>	
				     <div class="col-sm">
				     	DOUTOR(a): <br/>
				     	<?php echo $aviso['doutor']; ?>				    
				    </div>	

				     <form method="POST">
				     	<input type="hidden" value="<?php echo $aviso['id'] ?>" name="id_reserva">
				     	<input type="hidden" value="<?php echo $aviso['id_usuario'] ?>" name="id_usuario">
				     	<button name="btn_confirmar" class="btn btn-light" type="submit" value="<?php echo ($aviso['confirmado'] == 1)? 0 : 1; ?>">
				     		<?php echo ($aviso['confirmado'] == 1)? 'OK' : 'CONFIRMAR'; ?>
				     	</button><br/><br/>

				     	 <!-- Button trigger modal -->
					    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modaldelete">
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
			          <h5 class="modal-title" id="exampleModalLongTitle">DELETAR CONSULTA</h5>
			          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			            <span aria-hidden="true">&times;</span>
			          </button>
			        </div>
			        <div class="modal-body">
			          Tem certeza que deseja excluir essa consulta? 
			        </div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-info" data-dismiss="modal">CANCELAR</button>

			          erere
			        </div>
			      </div>
			    </div>
			  </div>		
              <hr/>
              <div style="margin-bottom: 20px; height: 100vh; " class="container">
              	<!--Calendário-->
			    <div id='calendar'></div>	              	
              </div>
            
   
<?php else: ?> 

<div class="container-fluid fundo">
	<center class="imagem-fundo">
		<img height="auto" width="100%" class="img-fluid" alt="Imagem com dentista e paciente" src="<?php echo BASE_URL; ?>assets/images/fundo.jpg">	
	</center>
</div>

<div class="container carousel-fade">
	<div id="carouselExampleControls" class="carousel slide slide-textos" data-ride="carousel">
  <div class="carousel-inner">
	<div class="carousel-item active">
	    <center class="text-light">
	    	<h2 class="display-2">Lorem ipsum dolor</h2>
	        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>	    	
	    </center> 
    </div>
    <div class="carousel-item">
        <center class="text-light">
	    	<h2 class="display-2">Ipsum dolor ipsum</h2>
	        <p>Ipsum dolor sit amet. Integer posuere erat a ante.</p>	    	
	    </center>
    </div>
    <div class="carousel-item">
       <center class="text-light">
	    	<h2 class="display-2">Dolor</h2>
	        <p>Integer posuere erat a ante.</p>	    	
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


    <footer class="container-fluid  text-end lead text-light">
      <div class="container">
        <div class="row">
          <div style="font-size: 13px" class="col-sm">
            © 2020 Copyright <br/>
            Desenvolvido por <a class="text-light" href="http://www.Lalehub.com.br">Lalehub</a>
          </div>
          <div class="col-sm" >
            Contato 
          </div>
          <div class="col-sm">
            Localização 
          </div>
        </div>
      </div>      
    </footer> 

<?php endif; ?>    

  
