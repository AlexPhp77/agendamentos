<?php 

class sairController extends controller{

	public function index(){

		if(isset($_SESSION['logado']) && !empty($_SESSION['logado'])){
			unset($_SESSION['logado']);
			?>
        	<script type="text/javascript">window.location.href="./";</script>
        	<?php  
			exit; 			
		}		
	}
}