<?php
require_once __DIR__.'/../views/config/sessionAuth.php';

$uploadDir = __DIR__ . '/elearning/';
$allowedExtensions = ['zip'];

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['scorm_file'])) {
    $file = $_FILES['scorm_file'];
    $moduleTitle = trim($_POST['module_title'] ?? '');
    $moduleDescription = trim($_POST['module_description'] ?? '');

    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Erreur lors de l'upload du fichier.");
    }

    if (empty($moduleTitle)) {
        die("Le titre du module est requis.");
    }

    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        die("Seuls les fichiers ZIP sont autorisés.");
    }

    $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
    $cleanFileName = removeAccents($originalName) . ".zip";
    $filePath = $uploadDir . $cleanFileName;

    if (!move_uploaded_file($file['tmp_name'], $filePath)) {
        die("Échec du téléchargement du fichier.");
    }

    $extractPath = $uploadDir . removeAccents($originalName);
    if (!is_dir($extractPath)) {
        mkdir($extractPath, 0777, true);
    }

    $zip = new ZipArchive;
    if ($zip->open($filePath) === TRUE) {
        $zip->extractTo($extractPath);
        $zip->close();
        echo "Fichier décompressé avec succès !<br>";
    } else {
        die("Erreur lors de la décompression du fichier ZIP.");
    }

    unlink($filePath);

    // 🔹 Enregistrement du module en base de données
    $stmt = $PDO->prepare("INSERT INTO scorm_modules (module_name, module_title, module_description) VALUES (:module_name, :module_title, :module_description)");
    $stmt->execute([
        'module_name' => removeAccents($originalName),
        'module_title' => $moduleTitle,
        'module_description' => $moduleDescription
    ]);

    echo "<p>📁 Module enregistré en base avec succès !</p>";
}
?>

<?php require __DIR__.'/../views/blocs/doctype.php'; ?>

<main class="container">
<h1>Gestion des modules SCORM</h1>

<h2>Uploader un module SCORM</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="module_title" class="form-label">Titre du module</label>
        <input type="text" name="module_title" id="module_title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="module_description" class="form-label">Description du module</label>
        <textarea name="module_description" id="module_description" class="form-control" rows="3"></textarea>
    </div>

    <div class="mb-3">
        <label for="scorm_file" class="form-label">Fichier SCORM (ZIP)</label>
        <input type="file" name="scorm_file" id="scorm_file" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>

<h3>Modules disponibles</h3>
<ul>
    <?php
    $modules = array_filter(scandir($uploadDir), function ($item) use ($uploadDir) {
        return $item !== '.' && $item !== '..' && is_dir("$uploadDir/$item");
    });

    foreach ($modules as $module) {
        echo '<li><a href="view_scorm.php?module=' . urlencode($module) . '">' . htmlspecialchars($module) . '</a></li>';
    }
    ?>
</ul>

<div class="mt-5">
    <a href="#" class="btn btn-success">créer un parcours de formation</a>
</div>

</main>

<?php require __DIR__.'/../views/blocs/footer.php'; ?>
<?php require __DIR__.'/../views/blocs/end.php'; ?>