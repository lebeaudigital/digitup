<?php
require_once __DIR__ . '/../../views/config/sessionAuth.php';
require_once '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$client = new Google_Client();
$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri($path . 'controllers/callbacks/plugin-callback.php');
$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    $oauth2 = new Google_Service_Oauth2($client);
    $userInfo = $oauth2->userinfo->get();

    // Extraire les informations utilisateur
    $email = $userInfo->email;
    $nom = $userInfo->familyName;
    $prenom = $userInfo->givenName;

    $response = [
        'token' => $token['access_token'],
        'email' => $email,
        'name' => "$prenom $nom",
    ];

    // Encoder la réponse en JSON pour l'envoyer au plugin
    $jsonResponse = json_encode($response);
    ?>
    <script>
        // Envoyer les données au plugin via postMessage
        window.opener.postMessage(<?php echo $jsonResponse; ?>, '*');
        // Fermer la fenêtre après l'envoi
        window.close();
    </script>
    <?php
    exit;
} else {
    ?>
    <script>
        alert('Erreur : Code de connexion manquant.');
        window.close();
    </script>
    <?php
    exit;
}