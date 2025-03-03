<?php
function uuid($input) {
    // Créer un hash SHA-1 de l'entrée
    $hash = sha1($input);

    // Convertir le hash en format UUID (8-4-4-4-12)
    $uuid = substr($hash, 0, 8) . '-' .
            substr($hash, 8, 4) . '-' .
            substr($hash, 12, 4) . '-' .
            substr($hash, 16, 4) . '-' .
            substr($hash, 20, 12);

    return $uuid;
}