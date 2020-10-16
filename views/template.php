<!DOCTYPE html>
<head lang="pt-br">

  <meta charset="utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/style.css">
  <link href='<?php echo BASE_URL; ?>assets/css/main.min.css' rel='stylesheet' />

  
  <link href='<?php echo BASE_URL; ?>assets/css/datatables.min.css' rel='stylesheet' />
  <link href='<?php echo BASE_URL; ?>assets/css/dataTables.bootstrap4.min.css' rel='stylesheet' />
  <link href='<?php echo BASE_URL; ?>assets/css/responsive.bootstrap4.min.css' rel='stylesheet' />

  <title>Deco Barbearia</title>   

</head>
<body>    
      <?php if(!isset($_SESSION['logadoFuncionario']) && empty($_SESSION['logadoFuncionario'])): ?>
    
      <header style="font-size: 18px;">
        <div class="container-fluid">
          <nav class="navbar navbar-dark bg-dark  navbar-expand-lg">
           
              <a class="navbar-brand ocultar" href="<?php echo BASE_URL; ?>./">
                 <center>
                    <img width="220px" src="<?php echo BASE_URL; ?>/assets/images/logo.png">    
                 </center>     
              </a>
            
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">                 
                  <?php if(isset($_SESSION['logado']) && !empty($_SESSION['logado']) OR isset($_SESSION['logadoFuncionario']) && !empty($_SESSION['logadoFuncionario'])): ?>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo BASE_URL; ?>sair">
                          <img width="60px" src="<?php echo BASE_URL; ?>assets/images/exit.svg">
                      </a>
                    </li> 
                  <?php else: ?>
                    <li class="nav-item active">
                      <a class="nav-link" href="<?php echo BASE_URL; ?>./">
                        <img width="60px" src="<?php echo BASE_URL; ?>assets/images/home.svg">
                        <span class="sr-only">(current)</span></a>
                    </li>                    
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo BASE_URL; ?>entrar">
                        <img width="60px" src="<?php echo BASE_URL; ?>assets/images/porta.svg">
                      </a>
                    </li> 
                  <?php endif; ?>                
                </ul>
              </div>
            </nav>           
        </div>
      </header>  

      <?php endif; ?>

      <div class="container-fluid">

        <?php $this->loadView($nameView, $dados); ?>  
        
      </div>   
    
    <script type="text/javascript">var BASE_URL = '<?php echo BASE_URL; ?>';</script>    
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.4.1.min.js"></script>
   
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script>
     <script src='<?php echo BASE_URL; ?>assets/js/datatables.min.js'></script> 



  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/responsive.bootstrap4.min.js"></script>

   

    <script src='<?php echo BASE_URL; ?>assets/js/tabela.js'></script>
    <script src='<?php echo BASE_URL; ?>assets/js/main.min.js'></script>


    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/calendario.js"></script> 
    <script src='<?php echo BASE_URL; ?>assets/js/pt-br.js'></script>

     <script src='<?php echo BASE_URL; ?>assets/js/theme-chooser.js'></script>
     
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.mask.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>

</body>
</html>