<?php 
require_once __DIR__.'/../views/config/sessionAuth.php';

$module = isset($_GET['module']) ? basename($_GET['module']) : '';

// 🔍 Vérifier si le module existe en base
$stmt = $PDO->prepare("SELECT * FROM scorm_modules WHERE module_name = :module_name");
$stmt->execute(['module_name' => $module]);
$scorm = $stmt->fetch();

if (!$scorm) {
    die("SCORM non trouvé en base !");
}

$scorm_id = $scorm->id;  // On récupère l'ID du SCORM

$modulePath = __DIR__ . "/elearning/$module";

// Vérification du fichier principal
if (file_exists("$modulePath/genially.html")) {
    $moduleIndex = $path . "/app/elearning/$module/genially.html";
} elseif (file_exists("$modulePath/index_lms.html")) {
    $moduleIndex = $path . "/app/elearning/$module/index_lms.html";
} else {
    die("❌ Aucun fichier SCORM valide trouvé !");
}

if (!$module || !is_dir($modulePath)) {
    die("SCORM non trouvé sur le serveur !");
}
?>

<?php require __DIR__.'/../views/blocs/doctype.php' ?>

    <div id="getIDs" data-user_id="<?= $Auth->user('user_id') ?>" data-scorm_id="<?= $scorm_id ?>"></div>

    <h1 class="text-center mt-4"><?= htmlspecialchars($scorm->module_title) ?></h1>
    
    <div class="container">
        <iframe src="<?= $moduleIndex ?>" width="100%" style="aspect-ratio:16/9" class="rounded shadow"></iframe>
        <div class="progress" style="height: 10px;">
            <div id="scormProgressBar" class="bg-primary" 
                role="progressbar" style="width: 10%;">
            </div>
        </div>
    </div>

<?php require __DIR__.'/../views/blocs/footer.php' ?>
<?php require __DIR__.'/../views/blocs/end.php' ?>