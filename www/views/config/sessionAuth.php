<?php
session_start();
include __DIR__.'/bdd_connect.php';
require_once __DIR__.'/../../models/Auth.php';

if (isAppDirectory()){
    $Auth->allow('contrib');
    if(!verifyToken($PDO) || $Auth->user('role') == 'member'){
        header('location:'.$path.'');
        die("P'tit malin dégage !!");
    }
}