<?php
function formatBytes($size, $precision = 2)
{
    $base = log($size, 1024);
    $suffixes = array('', 'Ko', 'Mo', 'Go', 'To');   

    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}