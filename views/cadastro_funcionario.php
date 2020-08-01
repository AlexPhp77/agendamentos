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
  	<h5 style="color: #17a2b8;" >Cadastrar funcionário</h5>
    <a href="<?php echo BASE_URL; ?>./">
    	<img width="30px" src="<?php echo BASE_URL; ?>assets/images/voltar.png">  	
    </a>
  </div>
  <hr/>
  <?php if(!empty($m)): ?>  
    <div class="alert alert-success" style="margin-top: 10px;">
      <?php echo $m; ?>
    </div>
    <?php elseif(!empty($m2)): ?>
     <div class="alert alert-danger" style="margin-top: 10px;">
      <?php echo $m2; ?>
    </div>    
  <?php endif; ?>
  <?php if(!empty($m3)): ?>
     <div class="alert alert-warning" style="margin-top: 10px;">
      <?php echo $m3; ?>
    </div>
  <?php endif; ?>
  <?php if(!empty($m4)): ?>
     <div class="alert alert-warning" style="margin-top: 10px;">
      <?php echo $m4; ?>
    </div>
  <?php endif; ?>
  <?php if(!empty($m5)):?>
     <div class="alert alert-warning" style="margin-top: 10px;">
      <?php echo $m5; ?>
    </div>
  <?php endif; ?>
  <?php if(!empty($m6)):?>
     <div class="alert alert-warning" style="margin-top: 10px;">
      <?php echo $m6; ?>
    </div>
  <?php endif; ?>
  <form method="POST">  
  <div class="form-row">
    <div class="col-md-6">
       <label for="nome">Nome</label>
       <input type="text" name="nome" class="form-control form-control-lg" id="nome" placeholder="Nome">      
    </div>
    <div class="col-md-6">
       <label for="sobrenome">Sobrenome</label>
       <input type="text" name="sobrenome" class="form-control form-control-lg" id="sobrenome" placeholder="Sobrenome">
    </div>   
  </div>


  <div class="form-row">
    <div class="col-md-6">
       <label for="idade">Idade</label>
       <input type="text" name="idade" class="form-control form-control-lg" id="idade" placeholder="Sua idade">      
    </div>

    <div class="col-md-6">
      <label for="sexo">Sexo</label>
      <select name="sexo" id="sexo" class="form-control form-control-lg">
        <option disabled selected>Selecionar</option>
        <option value="Masculino">Masculino</option>
        <option value="Feminino">Feminino</option>
      </select>      
    </div>   

  </div>

  <div class="form-row">
    <div class="col-md-12"> 
      <label for="cpf">CPF</label>
       <input type="text" name="cpf" class="form-control form-control-lg" id="cpf" placeholder="CPF">
    </div>     
  </div>
 
  <div class="form-row">
    <div class="col-md-6">
       <label for="email">E-mail (Obrigatório)</label>
       <input type="text" name="email" class="form-control form-control-lg" id="email" placeholder="exemplo@email.com">      
    </div>
    <div class="col-md-6">
      <label for="telefone">Telefone ou Celular</label>
      <input type="text" name="telefone" class="form-control form-control-lg" id="telefone" placeholder="(00) 00000-0000">      
    </div>
  </div>   

   <div class="form-row">
    <div class="col-md">
       <label for="estado">Estado</label>
       <input type="text" name="estado" class="form-control form-control-lg" id="estado" placeholder="Estado">      
    </div>
    <div class="col-md">
       <label for="cidade">Cidade</label>
       <input type="text" name="cidade" class="form-control form-control-lg" id="cidade" placeholder="Cidade">
    </div> 
    <div class="col-md">
       <label for="cep">CEP</label>
       <input type="text" name="cep" class="form-control form-control-lg" id="cep" placeholder="CEP">
    </div> 
    <div class="col-md">
       <label for="rua">Rua</label>
       <input type="text" name="rua" class="form-control form-control-lg" id="rua" placeholder="Rua">
    </div>  
    <div class="col-md">
       <label for="numero">Numero</label>
       <input type="text" name="numero" class="form-control form-control-lg" id="numero" placeholder="Numero">
    </div>  
    </div> 
    <div class="form-row">
    	<div class="col-md-6">
    		<label for="senha">Cadastre a senha de acesso</label>
            <input type="password" name="senha" class="form-control form-control-lg" id="senha" placeholder="Senha deve ter 8 ou mais caracteres">    		
    	</div>  
    	<div class="col-md-6">
		    <label for="nivelacesso">Permissões</label>
			<select name="nivelacesso" id="nivelacesso" class="form-control form-control-lg">
			    <option disabled selected>Selecionar</option>
			    <option value="DOUTOR">Odontologista</option>
			    <option value="SECRETARIO">Secretário(a)</option>
		    </select>      
        </div>   
    </div><br/>

      <?php if(empty($_SESSION['logadoFuncionario']) && $permissao['permissoes'] != 'SECRETARIO'): ?>
      
      <label for="codigo">Captcha</label>
      
      <div class="form-group row">
        
      <div style="margin-right: 30px" class="col-md-1">
        <img  src="<?php echo BASE_URL; ?>captcha/imagem.php">          
      </div>    
       
      <input style="border-radius: 0px; height: 50px;"  type="text" name="codigo" class="form-control form-control-lg col" id="codigo" placeholder="Insira o código">
        
      <div style="padding-left: 0px;" class="col-3">
        <button style="float: right;" type="submit" class="btn btn-info">Cadastrar</button> 
      </div>      
    </div>
    <?php else: ?>
    <button style="float: right;" type="submit" class="btn btn-info">Cadastrar</button>
    <?php endif; ?> 
    <br/> 
    
  </form> 
  <br/> 
</div>

