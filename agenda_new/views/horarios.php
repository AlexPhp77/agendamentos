<?php
    if(!isset($_SESSION['logadoFuncionario']) && empty($_SESSION['logadoFuncionario'])){
      ?>
      <script type="text/javascript">window.location.href="./"</script>
      <?php 
    } 
?> 


<div class="container">
	<hr/>
		<div style="display: flex; justify-content: space-between;">
			<h5 style="color: #17a2b8;" >
				<?php if(!empty($horarios)): ?>
				Todas as consultas do dia 
				<?php foreach ($horarios as $horario) {
                    echo date('d/m/Y', strtotime($horario['data_inicio']));
                    break;
				} ?>
				<?php else: ?>
					Não há consultas!
				<?php endif; ?>			
			</h5>
			<a href="<?php echo BASE_URL; ?>./">
			  <img width="30px" src="<?php echo BASE_URL; ?>assets/images/voltar.png">    
			</a>
		</div>
    <hr/>	
</div>

<br/>
<div class="container">

    <!--Avisos-->
	<div class="container">
	  <?php if(!empty($m)): ?>  
	  <div class="alert alert-danger" style="margin-top: 10px;">
	    <?php echo $m; ?>
	  </div>  
	  <?php endif; ?>  
	  <?php if(!empty($m2)): ?>  
	    <div class="alert alert-danger" style="margin-top: 10px;">
	      <?php echo $m2; ?>
	    </div>  
	  <?php endif; ?> 
	  <?php if(!empty($m3)): ?>  
	    <div class="alert alert-success" style="margin-top: 10px;">
	      <?php echo $m3; ?>
	    </div>  
	  <?php endif; ?>   				
	</div>


    <div class="container">
	    <form method="POST">
	      <div class="form-row">

	      	  <div class="form-group col-md-6">
	            <label for="paciente_id">Paciente(a)</label>
	                <select class="form-control form-control-lg" id="paciente_id" name="paciente_id">
	                    <option disabled selected>Selecionar</option>
	                    <?php foreach($pacientes as $paciente): ?>
	                      <option value="<?php echo $paciente['id']; ?>"><?php echo $paciente['nome']; ?></option>
	                    <?php endforeach; ?>                    
	                </select>               
	          </div>  


	          <div class="form-group col-md-6">
	            <label for="doutor">Doutor(a)</label>
	                <select class="form-control form-control-lg" id="doutor" name="doutor">
	                    <option disabled selected>Selecionar</option>
	                    <?php foreach($funcionarios as $funcionario): ?>
	                      <option value="<?php echo $funcionario['id']; ?>"><?php echo $funcionario['nome']; ?></option>
	                    <?php endforeach; ?>                    
	                </select>            
	          </div>	

	          <div class="form-group col-md-3">
	              <label for="data">Dia da consulta</label>           
	              <input  class="form-control form-control-lg"  id="data" type="date" name="data" placeholder="Selecionar">
	          </div>

	          <div class="form-group col-md-2">
	              <label for="hora">Hora início</label>
	              <select class="form-control form-control-lg" id="hora" name="hora"> 
	                  <option >08:00</option>
	                  <option >09:00</option>
	                  <option >10:00</option>
	                  <option >11:00</option>
	                  <option >14:00</option>
	                  <option >15:00</option>
	                  <option >16:00</option>        
	                  <option >17:00</option>         
	              </select>
	          </div> 

	      </div>  
	          <button type="submit" class="btn btn-info">Reservar</button>
	      </form>
	  </div>								
</div><br/>

<div class="container">
  <div class="row">

    <div class="col-sm">
    <table class="table table-sm table-hover">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Horário</th>
	      <th scope="col">Paciente</th>
	      <th scope="col">Doutor(a)</th>
	    </tr>
	  </thead>
	  <tbody>

	    <?php foreach($horarios as $key => $horario): ?>
	    <tr>
	        <th scope="row"><?php echo $key+1; ?></th>     
	      	<td><?php echo date('H:i', strtotime($horario['data_inicio']))." às ".date('H:i', strtotime($horario['data_fim'])); ?></td>   
	      	<td><?php echo $horario['paciente']; ?></td>   
	      	<td><?php echo $horario['dentista']; ?></td> 
	    </tr> 
	    <?php endforeach; ?>

	  </tbody>
	</table>
    </div>
  </div>
</div>