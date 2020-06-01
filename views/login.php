<?php

	if(isset($_SESSION['logado']) && !empty($_SESSION['logado'])){
		header('Location: ./');			
	}
?>  
    
<div class="container">
  <form method="POST">
  <?php if(!empty($m)): ?>  
    <div class="alert alert-warning" style="margin-top: 10px;">
      <?php echo $m; ?>
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
  <button type="submit" class="btn btn-info">Acessar</button>
</form>
</div>
 