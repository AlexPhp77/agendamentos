
<div class="container">

  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">DELETAR DADOS DO PACIENTE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Tem certeza que deseja excluir esse usuário? 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">CANCELAR</button>
            <?php if(isset($_GET['id'])){ $id = addslashes($_GET['id']);} ?>
            <a href="<?php echo BASE_URL; ?>paciente/deletar/?id_usuario=<?php echo $id; ?>">
            <button style="float: right; margin-left: 10px;" class="btn btn-danger">SIM</button>   
            </a>   
        </div>
      </div>
    </div>
  </div>
  
  <form method="POST">  
  <div class="form-row">
    <div class="col-md">
       <label for="nome">Nome completo</label>
       <input value="<?php  echo $nome; ?>" type="text" id="reserva" name="nome" class="form-control form-control-lg" id="nome" placeholder="Nome">      
    </div>    
  </div>


  <div class="form-row">
    <div class="col-md-6">
       <label for="idade">Idade</label>
       <input  value="<?php echo $idade; ?>" type="text" name="idade" class="form-control form-control-lg" id="idade" placeholder="Sua idade">      
    </div>
    <div class="col-md-6">
       <label for="cpf">CPF</label>
       <input value="<?php echo $cpf; ?>" type="text" name="cpf" class="form-control form-control-lg" id="cpf" placeholder="CPF">
    </div>   
  </div>
 
  <div class="form-row">
    <div class="col-md">
       <label for="email">E-mail</label>
       <input value="<?php echo $email; ?>" type="text" name="email" class="form-control form-control-lg" id="email" placeholder="exemplo@email.com">      
    </div>
  </div> 

   <div class="form-row">
    <div class="col-md">
      <label for="telefone">Telefone ou Celular</label>
      <input value="<?php echo $telefone; ?>" type="text" name="telefone" class="form-control form-control-lg" id="telefone" placeholder="(00) 00000-0000">      
    </div>
  </div> 

   <div class="form-row">
    <div class="col-md-6">
       <label for="estado">Estado</label>
       <input value="<?php echo $estado; ?>" type="text" name="estado" class="form-control form-control-lg" id="estado" placeholder="Estado">      
    </div>
    <div class="col-md-6">
       <label for="cidade">Cidade</label>
       <input value="<?php echo $cidade; ?>" type="text" name="cidade" class="form-control form-control-lg" id="cidade" placeholder="Cidade">
    </div> 
    <div class="col-md">
       <label for="cep">CEP</label>
       <input value="<?php echo $cep; ?>" type="text" name="cep" class="form-control form-control-lg" id="cep" placeholder="CEP">
    </div> 
    <div class="col-md">
       <label for="rua">Rua</label>
       <input value="<?php echo $rua; ?>" type="text" name="rua" class="form-control form-control-lg" id="rua" placeholder="Rua">
    </div>  
    <div class="col-md">
       <label for="numero">Numero</label>
       <input value="<?php echo $numero; ?>" type="text" name="numero" class="form-control form-control-lg" id="numero" placeholder="Numero">
    </div>  
  </div>
    <div style="margin-top: 10px">
    	<button type="submit" class="btn btn-info">Editar</button>           
    </div>   
  </form>    

    <!-- Button trigger modal -->
    <button style="float: right; margin-left: 10px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
      Deletar
    </button>
     
    <button style="float: right;" id="marcar" class="btn btn-outline-success">Marcar consulta</button>
  
  <br/><br/>
  <hr/>
  <?php if(!empty($m)): ?>  
    <div class="alert alert-danger" style="margin-top: 10px;">
      <?php echo $m; ?>
    </div>  
  <?php endif; ?>  

  <div class="aviso-delete">
  
  </div>

  <div class="reservar">
    
  </div> 

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
        Esse usuário tem consulta marcada dia <?php echo $datahora; ?>
    </div>
    <?php endfor; ?>
<?php endif; ?>


  <!--<?php /*if($aviso['aviso'] == true): ?>
    <div id="aviso-reserva" class="alert alert-success" role="alert">
      <?php $datahora = date('d/m/Y H:i', strtotime($aviso['horas'][0][1])); ?>
        Esse usuário tem consulta marcada dia <?php echo $datahora; ?>
    </div>
  <?php endif; */?> //Mostra apenas um horário-->
   
</div>