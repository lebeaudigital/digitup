<?php require_once __DIR__.'/../views/config/sessionAuth.php' ?>

<?php
$uploadDir = __DIR__ . '/elearning/';

// Vérification du module passé en paramètre
if (!isset($_GET['module']) || !is_dir($uploadDir . $_GET['module'])) {
    die("Module SCORM introuvable.");
}

$module = $_GET['module'];
$modulePath = $uploadDir . $module;

// Détection du fichier SCORM à afficher
$scormFile = null;
$possibleFiles = ['story.html', 'genially.html'];

foreach ($possibleFiles as $file) {
    if (file_exists($modulePath . '/' . $file)) {
        $scormFile = $file;
        break;
    }
}

// Vérification si un fichier SCORM valide a été trouvé
if (!$scormFile) {
    die("Aucun fichier SCORM valide trouvé dans ce module.");
}
?>

<?php require __DIR__.'/../views/blocs/doctype.php' ?>

<main class="container">
    <h1>Lecture du module : <?= htmlspecialchars($module) ?></h1>

    <p><strong>Progression :</strong> <span id="progress">0%</span></p>

    <iframe id="scormPlayer" src="<?= 'elearning/' . htmlspecialchars($module) . '/' . $scormFile ?>" width="100%" height="600px" frameborder="0"></iframe>
</main>

<script>
function updateProgressFromStorage() {
    let progress = localStorage.getItem("scorm_progress") || "0";
    document.getElementById("progress").textContent = progress + "%";
    console.log("📥 Lecture de la progression depuis localStorage :", progress + "%");
}

// Vérifier toutes les secondes si la progression a changé
setInterval(updateProgressFromStorage, 1000);
</script>

<?php require __DIR__.'/../views/blocs/footer.php' ?>
<?php require __DIR__.'/../views/blocs/end.php' ?>

<!--Est ce que au moment où tu décompresse les fichiers zip, tu peux écrire dans le fichier story.html ou genially.html pour ajouter la fonction sendProgressToParent() -->