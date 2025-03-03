<?php
function singular($word) {
    $lastThreeChar = strtolower(substr($word, -3));
    $lastChar = strtolower(substr($word, -1));
    switch ($lastChar) {
        case 's':
        if ($lastThreeChar === 'aux') {
            return substr($word, 0, -3) . 'al'; // cas particulier
        }
        return substr($word, 0, -1); // pluriel classique
        case 'x':
        return substr($word, 0, -1); // pluriel classique
        default:
        return $word; // singulier inchangé
    }
}