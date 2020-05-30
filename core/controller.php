<?php 
class controller{
	public function loadView($nameView, $dados = array()){
        
        extract($dados); /*pega os indíces do array e trasforma em uma variável, cada uma com seu determinado valor*/
		require "views/".$nameView.".php"; 
	}

	public function loadTemplate($nameView, $dados = array()){
	    		
        require 'views/template.php';
	}	
}