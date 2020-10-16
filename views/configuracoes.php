<?php 

if(!isset($_SESSION['logadoFuncionario']) && empty($_SESSION['logadoFuncionario']) && $permissao['permissoes'] != 'SECRETARIO'){

	header('Location:'.BASE_URL);

    }

?>