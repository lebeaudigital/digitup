<?php

// Définir le chemin du dossier contenant les fichiers à inclure
$dossier = __DIR__.'/CRUD';

// Ouvrir le dossier et lire son contenu
if ($handle = opendir($dossier)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != ".." && pathinfo($entry, PATHINFO_EXTENSION) == 'php') {
            include "$dossier/$entry";
        }
    }
    closedir($handle);
}
