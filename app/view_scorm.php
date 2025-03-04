<?php 
require_once __DIR__.'/../views/config/sessionAuth.php';

$module = isset($_GET['module']) ? basename($_GET['module']) : '';

// 🔍 Vérifier si le module existe en base
$stmt = $PDO->prepare("SELECT id FROM scorm_modules WHERE module_name = :module_name");
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

    <h1 class="text-center mt-4"><?= htmlspecialchars($module) ?></h1>
    <div class="container mt-4">
        <h4>Progression du SCORM</h4>
        <div class="progress" style="height: 30px;">
            <div id="scormProgressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
                role="progressbar" style="width: 10%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                0%
            </div>
        </div>
    </div>
    <iframe src="<?= $moduleIndex ?>" width="100%" height="800px"></iframe>

<?php require __DIR__.'/../views/blocs/footer.php' ?>
<?php require __DIR__.'/../views/blocs/end.php' ?>