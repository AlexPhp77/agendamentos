<?php
if(!isset($_SESSION['logado']) && empty($_SESSION['logado']) OR empty($dados)){
  //unset($_SESSION['logado']);
  ?>
  <script type="text/javascript">window.location.href="<?php echo BASE_URL; ?>./"</script>
  <?php
  exit;  
}

  /*Verifica quantos dias há em um mês*/
  $qtDiasMes = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); 

?>

<div class="container">

  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">DELETAR MINHA CONTA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Tem certeza que deseja deletar sua conta?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-info" data-dismiss="modal">CANCELAR</button>
           
            <a href="<?php echo BASE_URL; ?>usuario/?id_usuario=<?php echo $_SESSION['logado']; ?>">
            <button style="float: right; margin-left: 10px;" class="btn btn-danger">SIM</button>   
            </a>   
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <hr/>
    <h3 style="color: #daa520;">
    <?php $nomes = explode(' ', $nome);
    echo "Olá, ".$nomes['0']."!";
    ?>      
    </h3>   
    <hr/> 
  </div>

  <form method="POST" style="color: #daa520;">  
  <div class="form-row">
    <div class="col-md">
       <label for="nome">Nome completo</label>
       <input value="<?php  echo $nome; ?>" type="text" id="reserva" name="nome" class="form-control form-control-lg" id="nome" placeholder="Nome">      
    </div>    
  </div>


  <div class="form-row">
    <div class="col-md-6">
       <label for="idade">Idade</label>
       <input value="<?php echo $idade; ?>" type="text" name="idade" class="form-control form-control-lg" id="idade" placeholder="Sua idade">      
    </div>

    <div class="col-md-6">
      <label for="sexo">Sexo</label>
      <select name="sexo" id="sexo" class="form-control form-control-lg">
      <option value="Masculino" <?php echo ($sexo=='Masculino')?'selected="selected"':''; ?>>Masculino</option> 
      <option value="Feminino" <?php echo ($sexo=='Feminino')?'selected="selected"':''; ?>>Feminino</option>
      </select>      
    </div>   

  </div>

  <div class="form-row">
    <div class="col-md-6"> 
      <label for="cpf">CPF</label>
       <input value="<?php echo $cpf; ?>" type="text" name="cpf" class="form-control form-control-lg" id="cpf" placeholder="CPF">
    </div> 
     <div class="col-md-6">
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
      <button type="submit" class="btn btn-outline-info">Editar</button>           
    </div>   
  </form>    

    <!-- Button trigger modal -->
    <button style="float: right; margin-left: 10px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
      Deletar
    </button>
     
   
     <button style="float: right;" class="btn btn-outline-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
      Reservar <img width="15px" src="<?php echo BASE_URL; ?>assets/images/seta-baixo.svg">
     </button>     
  
  <br/><br/>
  <hr/>

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

  <div class="aviso-delete">
  
  </div>

  <div class="collapse" id="collapseExample">
    <div class="container">
      <h2>Obs: Não reserve domingos e feriados!</h2><br/>
    <form method="POST" style="color: #daa520;">
      <div class="form-row">
             

          <div class="form-group col-md-4">
              <label for="data">Dia</label> 
              <input type="date" class="form-control form-control-lg" id="data" name="data">

             

              <!-- mostra apenas dias do mês atual
              <label for="data">Dia</label>           
              <select class="form-control form-control-lg" id="data" name="data">
                <option >Selecionar dia</option>
                <?php// for($i=1; $i <= $qtDiasMes; $i++): ?>
              <option placeholder="Selecionar dia"><?php //echo $i ?></option>
              <?php //endfor; ?>
              </select>-->
          </div>


          <div class="form-group col-md-4">
              <label for="hora">Hora início</label>
              <select class="form-control form-control-lg" id="hora" name="hora"> 
                  <option >09:30</option>
                  <option >10:00</option>
                  <option >10:30</option>
                  <option >11:00</option>
                  <option >11:30</option>
                  <option >12:00</option>
                  <option >14:00</option>
                  <option >14:30</option>
                  <option >15:00</option>
                  <option >15:30</option>
                  <option >16:00</option>
                  <option >16:30</option>        
                  <option >17:00</option>
                  <option >17:30</option> 
                  <option >18:00</option>  
                  <option >18:30</option>     
              </select>
          </div>          
          <div class="form-group col-md-4">
            <label for="doutor">Barbeiro</label>
                <select class="form-control form-control-lg" id="doutor" name="doutor">
                    <option disabled selected>Selecionar</option>
                    <?php foreach($funcionarios as $funcionario): ?>
                      <option value="<?php echo $funcionario['id']; ?>"><?php echo $funcionario['nome']; ?></option>
                    <?php endforeach; ?>                    
                </select>            
          </div>
      </div>  
          <button type="submit" class="btn btn-outline-info">Reservar</button>
      </form>
  </div>
  <hr/>    
  </div>

<?php if(!empty($aviso)): ?>   

<?php if($aviso['aviso'] == true): ?>
    <?php for($i=0; $i < count($aviso['horas']); $i++): ?>  

    <?php if(isset($_SESSION['logado']) && !empty($_SESSION['logado'])){
     $id= $_SESSION['logado'];}
    ?> 

    <div id="aviso-reserva" class="alert alert-success" role="alert">      
    <button type="button" class="close" aria-label="Close"> 
    <a href="<?php echo BASE_URL; ?>usuario/?id=<?php echo $id; ?>&id_reserva=<?php echo $aviso['horas'][$i]['id'] ?>">
      <span value="excluir" input="submit" aria-hidden="true">&times;</span>        
    </a>
    </button>
      <?php $datahora = date('d/m/Y \à\s H:i', strtotime($aviso['horas'][$i]['data_inicio'])); ?>
        Você tem horário marcado dia <?php echo $datahora; ?> com o barbeiro
        <?php echo $aviso['horas'][$i]['nome']; ?>
       
    </div>
    <?php endfor; ?>
<?php endif; ?>

<?php endif; ?>

  <!--<?php /*if($aviso['aviso'] == true): ?>
    <div id="aviso-reserva" class="alert alert-success" role="alert">
      <?php $datahora = date('d/m/Y H:i', strtotime($aviso['horas'][0][1])); ?>
        Esse usuário tem consulta marcada dia <?php echo $datahora; ?>
    </div>
  <?php endif; */?> //Mostra apenas um horário-->
   
</div>