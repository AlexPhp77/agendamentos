<?php

	if(isset($_SESSION['logado']) && !empty($_SESSION['logado'])){
	    ?>
	    <script type="text/javascript">window.location.href="./"</script>
	    <?php
	}

?>  


<div class="container cor-texto-form">
  <h3>Login para os clientes</h3>
  <form method="POST">
  <?php if(!empty($m)): ?>  
    <div class="alert alert-warning" style="margin-top: 10px;">
      <?php echo $m; ?>
    </div>   
  <?php endif; ?>
  <?php if(!empty($m2)): ?>  
    <div class="alert alert-danger" style="margin-top: 10px;">
      <?php echo $m2; ?>
    </div>   
  <?php endif; ?>
  <div class="form-group">
    <label for="email">E-mail</label>
    <input type="text" name="email" class="form-control form-control-lg" id="email" placeholder="Digite o e-mail cadastrado">
  </div>
  <div class="form-group">
    <label for="senha">Senha</label>
    <input type="password" name="senha" class="form-control form-control-lg" id="senha" placeholder="Digite sua senha">
    <a style="font-size: 13px;" href="<?php echo BASE_URL; ?>recuperar">Esqueceu sua senha? Clique aqui!</a>
  </div> 
  <div class="form-group row col-3">
    <label for="codigo">Captcha</label>
    <input type="text" name="codigo" class="form-control form-control-lg" id="codigo" placeholder="Insira o código">   
  </div> 
  <div class="form-group">
    <img src="<?php echo BASE_URL; ?>captcha/imagem.php">    
  </div>
  <button style="margin-bottom: 10px;" type="submit" class="btn btn-outline-info">Acessar</button>
</form>
</div>
 