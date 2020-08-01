<?php 

class sairController extends controller{

	public function index(){

		if(isset($_SESSION['logado']) && !empty($_SESSION['logado']) OR isset($_SESSION['logadoFuncionario']) && !empty($_SESSION['logadoFuncionario'])){
			unset($_SESSION['logadoFuncionario']);
			unset($_SESSION['logado']);
			?>
        	<script type="text/javascript">window.location.href="./";</script>
        	<?php  
			exit; 			
		}		
	}
}