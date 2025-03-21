<?php
function removeAccents($str, $encoding='utf-8')
{
    // transformer les caractères accentués en entités HTML
    $str = htmlentities($str, ENT_NOQUOTES, $encoding);
 
    // remplacer les entités HTML pour avoir juste le premier caractères non accentués
    // Exemple : "&ecute;" => "e", "&Ecute;" => "E", "à" => "a" ...
    $str = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $str);
 
    // Remplacer les ligatures tel que : , Æ ...
    // Exemple "œ" => "oe"
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
    // Supprimer tout le reste
    $str = preg_replace('#&[^;]+;#', '', $str);

    $str = str_replace("'",'', $str);
    $str = str_replace(" ?",'', $str);
    $str = str_replace("?",'', $str);
    $str = str_replace(" !",'', $str);
    $str = str_replace("!",'', $str);
    $str = str_replace(".",'', $str);
    $str = str_replace(":",'', $str);
    $str = str_replace(" ",'-', $str);
    $str = str_replace("_",'-', $str);
    $str = strtolower($str);
 
    return $str;
}