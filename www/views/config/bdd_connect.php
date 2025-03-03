<?php 
require_once __DIR__.'/config.php';

$dhost = decrypto($host); 
$dbdd = decrypto($bdd); 
$dlogin = decrypto($login); 
$dpass = decrypto($pass); 

if (!isset($PDO)) {
    try{
        $PDO = new PDO("mysql:host=$dhost;dbname=$dbdd",$dlogin,$dpass);
        $PDO->exec("SET NAMES 'UTF8'"); 
        $PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
        $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
    }catch(PDOException $e){
        if($page != 'install'){
            header('Location: install/st-install.php');
            exit();
        }
        //echo 'Connexion impossible: '. $e;
    }
}