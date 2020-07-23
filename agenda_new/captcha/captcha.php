<?php 

if(!isset($_SESSION['captcha'])){ // se sessão não existir irá gerar código
  $n = rand(1000, 9999);
    $_SESSION['captcha'] = $n;
}