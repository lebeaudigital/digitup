<?php
require __DIR__ . '/../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../..');
$dotenv->load();

$website = $_ENV['DB_NAME_LOCAL'];
$noCacheFile = strtotime(Date('Y-m-d h:i:s'));


if($_SERVER['HTTP_HOST'] == "localhost:8888" || $_SERVER['HTTP_HOST'] == "192.168.1.128:8888" ){ 
    $host 		= $_ENV['DB_HOST_LOCAL'];
	$login		= $_ENV['DB_USER_LOCAL'];
	$pass 		= $_ENV['DB_PASSWORD_LOCAL'];
    $bdd		= $_ENV['DB_NAME_LOCAL'];
}else{
    $host 		= $_ENV['DB_HOST'];
	$login		= $_ENV['DB_USER'];
	$pass 		= $_ENV['DB_PASSWORD'];
    $bdd		= $_ENV['DB_NAME'];
}

include __DIR__.'/../../controllers/functions.php';
include __DIR__.'/../../models/crud.php';
include __DIR__.'/../../controllers/i18n.php';

if($_SERVER['HTTP_HOST'] == "localhost:8888" || $_SERVER['HTTP_HOST'] == "192.168.1.128:8888"){
    $website    = decrypto($website); 
    $path       = "http://".$_SERVER['HTTP_HOST']."/".$website."/www/";
}else{
    global $path;
    $path       = "https://".$_SERVER['SERVER_NAME']."/";
}