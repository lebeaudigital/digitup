<?php
function fractionToBootstrap($fraction) {
    $parts = explode('-', $fraction);
    $numer = (int)$parts[0];
    $denom = (int)$parts[1];
    if ($denom === 0) {
        return 'col-md-12';
    }
    $colNum = round(12 * $numer / $denom);
    return 'col-md-' . $colNum;
}