<link rel="manifest" href="ws.webmanifest.json">
<?php 
session_start();

if(empty($_SESSION['seguranca'])){/*IP usuário e a referência ao seu navegador*/
	$_SESSION['seguranca'] = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
}

$token =  md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
if($_SESSION['seguranca'] != $token){
	exit; 
}

require 'captcha/captcha.php';

//require_once 'vendor/autoload.php';

define('BASE_URL', 'http://localhost/barbearia/');
//define('BASE_URL', 'https://amostra.lalehub.com.br/agenda/');
date_default_timezone_set('America/Sao_Paulo');

spl_autoload_register(function($class){

	if(file_exists('controllers/'.$class.'.php')){
		require 'controllers/'.$class.'.php';
	} 
	elseif(file_exists('models/'.$class.'.php')){
		require 'models/'.$class.'.php';
	} 
	elseif(file_exists('core/'.$class.'.php')){
		require 'core/'.$class.'.php';
	}elseif(file_exists($class.'.php')){
		require $class.'.php';
	}

});

$core = new Core();
$core->comecar();