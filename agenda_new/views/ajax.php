<?php 

if(!empty($pesquisado)){

	foreach ($pesquisado as $d) {
	    echo "<a href=".BASE_URL."paciente/?id=".$d['id'].">".$d['nome']."</a><br/>";

    }
}

?>