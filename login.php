<?php
require_once __DIR__.'/views/config/sessionAuth.php';
require_once __DIR__.'/vendor/autoload.php'; // Charger l'autoload de Google API Client
$page = 'login';
$erreur = "";

// Configuration Google OAuth
$client = new Google_Client();
$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri($path.'controllers/callbacks/callback.php');
$client->addScope('email');
$client->addScope('profile');

$login_url = $client->createAuthUrl();

// Traitement de la connexion classique
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['connect'])) {
    if (isset($_POST['mail'], $_POST['password'])) {
        $d = [
            'mail' => $_POST['mail'],
            'password' => $_POST['password'],
        ];
        if ($Auth->login($d)) {
            switch ($Auth->user('role')) {
                case 'admin':
                    header('Location: app/index.php');
                    break;
                case 'supAdmin':
                    header('Location: app/index.php'); 
                    break;
                case 'contrib':
                    header('Location: app/index.php'); 
                    break;
                default:
                    header('Location: index.php'); 
                    break;
            }
            exit;
        } else {
            $erreur = $Auth->erreur;
        }
    }
}
?>

<?php include __DIR__.'/views/blocs/doctype.php'; ?>


<section class="d-flex align-items-center justify-content-center py-4 vh-100 position-relative">
    
    <main class="form-signin w-100">
    
        <form action="" method="POST">
            <div class="d-flex flex-wrap justify-content-center mb-4">
                <img src="<?= $path ?>assets/img/sitetyper.png" alt="" width="150">
            </div>

            <?php if ($erreur): ?>
                <p style="color: red;"><?php echo htmlspecialchars($erreur); ?></p>
            <?php endif; ?>
            
            <div class="form-floating">
                <input type="email" class="form-control" id="mail" name="mail" placeholder="Adresse de messagerie" required>
                <label for="mail">Adresse de messagerie</label>
            </div>
            <div class="form-floating show_hide_password">
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" autocomplete="new-password">
                <label for="password">Mot de passe</label>
                <span class="showHideIcon"><i class="bi bi-eye-slash" aria-hidden="true"></i></span>
            </div>

            <button class="btn btn-dark py-2 mt-4 w-100" type="submit" name="connect">Connexion</button>

            <div class="d-flex flex-column justify-content-center align-content-center align-items-center w-100">
                <p class="mb-0 mt-3 text-light small">Pas encore de compte ?</p>
                <a href="register.php" class="small text-secondary ">Inscription</a>
            </div>

            <div class="d-block mb-4"></div>
            <hr class="border border-light border-1 opacity-25">
            <div class="d-block mt-4"></div>

            <!-- Bouton de connexion Google -->
            <div class="d-flex justify-content-center mt-3">
                <a href="<?= $login_url ?>" class="btn btn-light btn-lg d-flex justify-content-center align-items-center shadow-sm border rounded-pill py-3 w-100">
                    <img src="https://img.icons8.com/color/48/000000/google-logo.png" alt="Google Logo" class="me-4" width="24" height="24">
                    <span class="fs-6">Sign in with Google</span>
                </a>
            </div>

        </form>

    </main>

</section>

<?php include __DIR__.'/views/blocs/end.php'; ?>
<?php include __DIR__.'/views/blocs/footer.php'; ?>