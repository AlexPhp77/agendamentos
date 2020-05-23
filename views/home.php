


<?php if(isset($_SESSION['logado']) && !empty($_SESSION['logado']) && $permissao['permissoes'] == 'ADMINISTRADOR'): ?>
	<div class="container">  
		    <div>
		    	<?php echo "Área restrita ( ".$permissao['permissoes']." )";  ?>
		    </div>
			<table class="table table-dark table-hover table-responsive-lg ">
			  <thead>
			    <tr>
			      <th style="font-size: 14px">
			      	<?php echo $total_reg; ?> pacientes cadastrados  
			      </th>	
			      <th scope="col" colspan="5">
			      	<form method="POST" class="form-inline my-2 my-lg-0 flex-row-reverse">			      		
					    <input id="busca" name="nome"  class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Search">
					</form>			      	
			      </th>			         
			    </tr>
			    <tr><th class="teste" colspan="5"></th></tr>  
			  </thead>
			  <tbody>			            
              <thead>
              	 <th scope="col">#</th>
              	 <th scope="col">NOME</th>
			     <th scope="col">CPF</th>
			     <th scope="col">E-MAIL</th>
			     <th scope="col">TELEFONE</th>
              </thead>

			  <?php foreach($lista as $chave => $usuario):  ?>
			    <tr>
			     
			      <th scope="row"><?php echo $chave + 1; ?></th>	
			         		    
			      	<td>
			      	<a class="text-light" href="<?php echo BASE_URL; ?>paciente/?id=<?php echo $usuario['id'] ?>">
			      		<?php echo $usuario['nome']?></td>
			      	</a>			     
			      <td><?php echo $usuario['cpf']?></td>    
			      <td><?php echo $usuario['email']?></td>
			      <td><?php echo $usuario['telefone']?></td>
			    </tr>			   
			  <?php endforeach; ?>
			   
			  </tbody>
			</table>	

			<?php if($total_reg > $por_pagina): ?>

				<nav aria-label="Page navigation example">
				  <ul class="pagination pagination-lg justify-content-center bg-dark">

	             
				    <li class="page-item"><a class="page-link bg-dark text-light"  <?php if(isset($_GET['p']) && !empty($_GET['p'])){$pagina = addslashes($_GET['p']) -1; ?> href="<?php echo ($pagina >= 1) ? '?p='.$pagina  :''; ?>"   <?php } ?>  >Anterior</a></li>			
	                
	                <?php for($i = 1; $i <= $por_pagina; $i++): ?>
	                	<?php if($i <= 6):?>
				        <li class="page-item"><a class="page-link bg-dark text-light" href="<?php echo BASE_URL; ?>?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
				         <?php endif; ?>
				    <?php endfor; ?>   
	             
	                <li class="page-item"><a class="page-link bg-dark text-light"  <?php if(isset($_GET['p']) && !empty($_GET['p']) && $_GET['p']){$pagina = addslashes($_GET['p']) +1; } else { $pagina = '2'; } ?> href="<?php echo ($pagina <= $por_pagina) ? '?p='.$pagina  :''; ?>"     >Próximo</a></li>	
				   
				  </ul>
			    </nav>	

			<?php endif; ?>				
			
	</div>
<?php endif; ?>

<?php if(!isset($_SESSION['logado']) && empty($_SESSION['logado'])): ?>
<div class="container-fluid">
	<center>
		<img height="auto" width="100%" class="img-fluid" alt="Imagem com dentista e paciente" src="<?php echo BASE_URL; ?>assets/images/fundo.jpg">	
	</center>
</div>

<div class="container carousel-fade">
	<div id="carouselExampleControls" class="carousel slide slide-textos" data-ride="carousel">
  <div class="carousel-inner">
	<div class="carousel-item active">
	    <center class="text-light">
	    	<h2 class="display-2">Lorem ipsum dolor</h2>
	        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>	    	
	    </center> 
    </div>
    <div class="carousel-item">
        <center class="text-light">
	    	<h2 class="display-2">Ipsum dolor ipsum</h2>
	        <p>Ipsum dolor sit amet. Integer posuere erat a ante.</p>	    	
	    </center>
    </div>
    <div class="carousel-item">
       <center class="text-light">
	    	<h2 class="display-2">Dolor</h2>
	        <p>Integer posuere erat a ante.</p>	    	
	    </center> 
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>	
</div>


    <footer class="container-fluid  text-end lead text-light">
      <div class="container">
        <div class="row">
          <div class="col-sm">
            © 2020 Copyright
          </div>
          <div class="col-sm" >
            Contato 
          </div>
          <div class="col-sm">
            Localização 
          </div>
        </div>
      </div>      
    </footer> 

<?php endif; ?>


<!--
<?php /*foreach($lista as $chave => $reservado):  ?>                
                <?php
                    $data1 = date('d/m/Y H:i', strtotime($reservado['data_inicio']));
                    $data2 = date('H:i', strtotime($reservado['data_fim']));               
                ?>                
			    <tr>
			      <th scope="row"><?php echo $chave + 1; ?></th>
			      <td><?php echo $reservado['nome']?></td>    
			      <td colspan="3"><?php echo $data1." às ".$data2; ?></td>     
			    </tr>
			  <?php endforeach;*/ ?>	  
-->