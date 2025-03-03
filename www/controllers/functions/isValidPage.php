<?php
function isValidPage($url, $validPages) {
    $segments = explode('/', $url);
    $currentLevel = $validPages;

    foreach ($segments as $segment) {
        // Vérifie si le niveau actuel est un tableau et contient le segment
        if (is_array($currentLevel) && array_key_exists($segment, $currentLevel)) {
            // Descendre d'un niveau dans la hiérarchie
            $currentLevel = $currentLevel[$segment];
        } elseif (is_array($currentLevel) && in_array($segment, $currentLevel)) {
            // Le segment est une page finale valide
            return true;
        } else {
            // Si le segment n'est pas trouvé, l'URL n'est pas valide
            return false;
        }
    }

    return true;
}
