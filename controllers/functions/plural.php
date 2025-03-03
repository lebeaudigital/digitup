<?php
function plural($word) {
    $lastChar = strtolower(substr($word, -1));
    switch ($lastChar) {
      case 's':
        return $word . 'es'; // féminin pluriel
      case 'x':
        return $word . 's'; // pluriel classique
      case 'l':
        return substr($word, 0, -1) . 'ux'; // cas particulier
      default:
        return $word . 's'; // pluriel classique
    }
}