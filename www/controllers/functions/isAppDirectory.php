<?php
function isAppDirectory() {
    // Récupère le chemin complet du script en cours d'exécution
    $currentScriptPath = $_SERVER['SCRIPT_FILENAME'];
    // Vérifie si le chemin contient le dossier "app"
    return strpos($currentScriptPath, '/app/') !== false;
}