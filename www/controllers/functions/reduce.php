<?php

function reduce($article, $nb_car, $delim='...') {
    $length = $nb_car;
    if($nb_car<strlen($article)){
    while (($article[$length] != " ") && ($length > 0)) {
        $length--;
    }
    if ($length == 0) return substr($article, 0, $nb_car) . $delim;
        else return substr($article, 0, $length) . $delim;
    }else return $article;
}