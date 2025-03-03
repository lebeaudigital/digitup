<?php
function generateSlug($string) {
    // Convertir en minuscules
    $slug = strtolower($string);
    // Supprimer les accents
    $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $slug);
    // Supprimer les caractères non désirés
    $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
    // Remplacer les espaces et les tirets multiples par un seul tiret
    $slug = preg_replace('/[\s-]+/', '-', $slug);
    // Supprimer les tirets en début et en fin de chaîne
    $slug = trim($slug, '-');
    return $slug;
}