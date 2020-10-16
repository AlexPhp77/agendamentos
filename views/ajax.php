<?php 

if(!empty($pesquisado)){

	//foreach ($pesquisado as $d) {
	   // echo "<a href=".BASE_URL."cliente/?id=".$d['id'].">".$d['nome']."</a><br/>";
	   
    // }

    echo "<select class='form-control' name='nome'>";
			foreach($pesquisado as $d){
		echo "<option value=".$d['id'].">".$d['nome']."</option>";
			}
	echo	"</select>";
}

?>