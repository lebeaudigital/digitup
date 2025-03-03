<?php
$browserLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$arrayLang = "";
$langue = "fr";

if($langue == "fr"){
    $browserLang = "fr";
    $arrayLang = 0;
}elseif($langue == 'en'){
    $browserLang = "en";
    $arrayLang = 1;
}

$countries = [
    0 => ['countryFR' => 'France', 'local' => 'Français', 'lang' => 'French','codeCountry' => 'fr', 'codeLang' => 'fr', 'flag' => 'fr', 'browser' => 'fr'], 
    1 => ['countryFR' => 'English', 'local' => 'English', 'lang' => 'English','codeCountry' => 'gb', 'codeLang' => 'en', 'flag' => 'gb', 'browser' => 'en']
];