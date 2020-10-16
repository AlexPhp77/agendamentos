<?php

  if(isset($_SESSION['logado']) && !empty($_SESSION['logado'])){
    header('Location: ./');     
  }
?>

<div class="container"> 
  <form method="POST" style="color: #daa520;">
  <?php if(!empty($m)): ?>  
    <div class="alert alert-warning" style="margin-top: 10px;">
      <?php echo $m; ?>
    </div>   
  <?php endif; ?>
  <div class="form-group">
    <label for="email">Seu E-mail</label>
    <input type="text" name="email" class="form-control form-control-lg" id="email" placeholder="Digite o e-mail cadastrado">
  </div>  
  <button type="submit" class="btn btn-outline-info">Enviar</button>
</form>
</div>