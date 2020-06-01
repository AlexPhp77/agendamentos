<?php

	if(isset($_SESSION['logado']) && !empty($_SESSION['logado'])){
		header('Location: ./');			
	}
?>
<?php if(!$codigo == false){  ?>

<div class="container">
  <form method="POST">
  <?php if(!empty($m)): ?>  
    <div class="alert alert-warning" style="margin-top: 10px;">
      <?php echo $m; ?>
    </div>   
  <?php endif; ?>
  <?php if(!empty($m2)): ?>  
    <div class="alert alert-success" style="margin-top: 10px;">
      <?php echo $m2; ?>
    </div>   
  <?php endif; ?>
  <div class="form-group">
    <label for="senha">Digite sua nova senha</label>
    <input type="password" name="senha" class="form-control form-control-lg" id="senha" placeholder="Sua senha deve ter 8 ou mais caracteres">
  </div>
  <div class="form-group">
    <label for="senha">Digite sua senha novamente</label>
    <input type="password" name="senha2" class="form-control form-control-lg" id="senha2" placeholder="Sua senha deve ter 8 ou mais caracteres">
  </div>  
  <button type="submit" class="btn btn-info">Alterar Senha</button>
</form>
</div>

<?php
    } else {
    	echo "<br/><div class='container alert alert-danger'>Link inválido ou inspirado!</div>";
    	exit;      
    }
?>

