<?php

class Core{

	public function comecar(){

		$url = '/';
		if(isset($_GET['url'])){
			$url .= $_GET['url'];
		}
		$params = array();
		if(!empty($url) && $url != '/'){
			$url = explode('/', $url);
			array_shift($url);

			$atualController = $url[0].'Controller';
			array_shift($url);

			if(isset($url[0]) && !empty($url[0])){
				$atualAction = $url[0];
				array_shift($url);
			} else{
				$atualAction = 'index';
			}

			if(count($url) > 0){
				$params = $url; 
			}
			
		} else{
			$atualController = 'homeController';
			$atualAction = 'index';
		}
        
        if(class_exists($atualController)){
        	$c = new $atualController();
        } else {
        	$c = new homeController();
        }        

        if(!method_exists($atualController, $atualAction)){
        	$atualAction = 'index';
        }
		
		//$c = new $atualController(); 
		//$c->$atualAction($params);// testar
		//em vez
		call_user_func_array(array($c, $atualAction), $params);
        //echo '<br/>'; 
		//print_r($url);
	}
}