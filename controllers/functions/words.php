<?php
function after ($thisObj, $inthat)
{
    if (!is_bool(strpos($inthat, $thisObj)))
    return substr($inthat, strpos($inthat,$thisObj)+strlen($thisObj));
};

function after_last ($thisObj, $inthat)
{
    if (!is_bool(strrevpos($inthat, $thisObj)))
    return substr($inthat, strrevpos($inthat, $thisObj)+strlen($thisObj));
};

function before ($thisObj, $inthat)
{
    return substr($inthat, 0, strpos($inthat, $thisObj));
};

function before_last ($thisObj, $inthat)
{
    return substr($inthat, 0, strrevpos($inthat, $thisObj));
};

function between ($thisObj, $that, $inthat)
{
    return before ($that, after($thisObj, $inthat));
};

function between_last ($thisObj, $that, $inthat)
{
 return after_last($thisObj, before_last($that, $inthat));
};

function strrevpos($instr, $needle)
{
    $rev_pos = strpos (strrev($instr), strrev($needle));
    if ($rev_pos===false) return false;
    else return strlen($instr) - $rev_pos - strlen($needle);
};

function sanitizeFileName($fileName) {
    // Tableau de caractères indésirables à remplacer
    $unwanted_array = array(
        'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a',
        'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o',
        'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e',
        'Ç'=>'C', 'ç'=>'c',
        'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i',
        'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ü'=>'u',
        'Ñ'=>'N', 'ñ'=>'n',
        'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z',
        ' '=>'_', '\''=>'_', '’'=>'_', '“'=>'_', '”'=>'_', '–'=>'-', '—'=>'-',
    );
    
    // Remplacement des caractères indésirables
    $fileName = strtr($fileName, $unwanted_array);

    // Convertir en minuscules
    $fileName = strtolower($fileName);

    // Supprimer tout ce qui n'est pas alphanumérique, tiret ou underscore
    $fileName = preg_replace('/[^a-z0-9_\-\.]/', '', $fileName);

    // Si le nom du fichier est vide après nettoyage, lui attribuer un nom par défaut
    if (empty($fileName)) {
        $fileName = 'fichier_upload';
    }

    return $fileName;
}
