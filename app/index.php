<?php require_once __DIR__.'/../views/config/sessionAuth.php' ?>

<?php
$uploadDir = __DIR__ . '/elearning/';
$allowedExtensions = ['zip'];

// Vérification et création du dossier si nécessaire
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['scorm_file'])) {
    $file = $_FILES['scorm_file'];

    // Vérification des erreurs d'upload
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Erreur lors de l'upload du fichier.");
    }

    // Vérification de l'extension
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        die("Seuls les fichiers ZIP sont autorisés.");
    }

    // Nom du fichier sans accents
    $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
    $cleanFileName = removeAccents($originalName) . ".zip";
    $filePath = $uploadDir . $cleanFileName;

    // Déplacer le fichier uploadé
    if (!move_uploaded_file($file['tmp_name'], $filePath)) {
        die("Échec du téléchargement du fichier.");
    }

    // Décompression du fichier ZIP
    $extractPathOriginal = $uploadDir . $originalName; // Garde le nom original
    if (!is_dir($extractPathOriginal)) {
        mkdir($extractPathOriginal, 0777, true);
    }

    $zip = new ZipArchive;
    if ($zip->open($filePath) === TRUE) {
        $zip->extractTo($extractPathOriginal);
        $zip->close();
        echo "Fichier décompressé avec succès !<br>";
    } else {
        die("Erreur lors de la décompression du fichier ZIP.");
    }

    // Renommer uniquement le dossier exporté
    $extractPathClean = $uploadDir . removeAccents($originalName);
    if ($extractPathOriginal !== $extractPathClean) {
        rename($extractPathOriginal, $extractPathClean);
    }

    // Suppression du fichier ZIP après extraction
    if (file_exists($filePath)) {
        unlink($filePath);
        echo "Fichier ZIP supprimé avec succès !<br>";
    }

    // Injection du script dans scorm.js après extraction
    $scormJsPath = $extractPathClean . "/app/scorm.js";

    if (file_exists($scormJsPath)) {
        $scormJsContent = file_get_contents($scormJsPath);
        
        // Remplacement du code original par la version avec localStorage
        $scormJsContent = str_replace(
            'this.pipwerks.SCORM.data.set("cmi.core.score.raw",e)',
            'this.pipwerks.SCORM.data.set("cmi.core.score.raw", e);localStorage.setItem("scorm_progress", e); console.log("📤 Progression SCORM stockée dans localStorage :", e);',
            $scormJsContent
        );

        file_put_contents($scormJsPath, $scormJsContent);
        echo "✅ Modification automatique de scorm.js terminée !<br>";
    }
}
?>

<?php require __DIR__.'/../views/blocs/doctype.php' ?>

<main class="container">
<h1>Test</h1>

<h2>Uploader un module SCORM</h2>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="scorm_file" required>
    <button type="submit">Envoyer</button>
</form>

<h3>Modules disponibles</h3>
<ul>
    <?php
    // Lister les modules SCORM présents dans le dossier elearning/
    $modules = array_diff(scandir($uploadDir), array('.', '..'));

    foreach ($modules as $module) {
        if (is_dir($uploadDir . $module)) {
            echo '<li><a href="view_scorm.php?module=' . urlencode($module) . '">' . htmlspecialchars($module) . '</a></li>';
        }
    }
    ?>
</ul>

</main>

<?php require __DIR__.'/../views/blocs/footer.php' ?>
<?php require __DIR__.'/../views/blocs/end.php' ?>