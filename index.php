<?php 
session_start();

define('BASE_URL', 'http://localhost/sistemas/agendamentos/');
date_default_timezone_set('America/Sao_Paulo');

spl_autoload_register(function($class){

	if(file_exists('controllers/'.$class.'.php')){
		require 'controllers/'.$class.'.php';
	} 
	else if(file_exists('models/'.$class.'.php')){
		require 'models/'.$class.'.php';
	} 
	else if(file_exists('core/'.$class.'.php')){
		require 'core/'.$class.'.php';
	}else if(file_exists($class.'.php')){
		require $class.'.php';
	}

});

$core = new Core();
$core->comecar();