<!DOCTYPE html>
<head lang="pt-br">

  <meta charset="utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/style.css">
  <link href='<?php echo BASE_URL; ?>assets/css/main.min.css' rel='stylesheet' />

  <title>Agenda</title>   

</head>
<body>    
    
      <header style="font-size: 18px;">
        <div class="container-fluid">
          <nav class="navbar navbar-dark bg-info fixed-top navbar-expand-lg">
              <a class="navbar-brand" href="<?php echo BASE_URL; ?>./">SUAMARCA</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">                 
                  <?php if(isset($_SESSION['logado']) && !empty($_SESSION['logado']) OR isset($_SESSION['logadoFuncionario']) && !empty($_SESSION['logadoFuncionario'])): ?>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo BASE_URL; ?>sair">Sair</a>
                    </li> 
                  <?php else: ?>
                    <li class="nav-item active">
                      <a class="nav-link" href="<?php echo BASE_URL; ?>./">Home<span class="sr-only">(current)</span></a>
                    </li>                    
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo BASE_URL; ?>login">Entrar</a>
                    </li> 
                  <?php endif; ?>                
                </ul>
              </div>
            </nav>           
        </div>
      </header>  

      <div class="container-fluid">

        <?php $this->loadView($nameView, $dados); ?>  
        
      </div>   

    <script type="text/javascript">var BASE_URL = '<?php echo BASE_URL; ?>';</script>
  	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.4.1.min.js"></script> 
    <script src='<?php echo BASE_URL; ?>assets/js/main.min.js'></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/calendario.js"></script> 
    <script src='<?php echo BASE_URL; ?>assets/js/pt-br.js'></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.mask.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
</body>
</html>