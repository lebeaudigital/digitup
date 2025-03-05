<?php
require_once __DIR__ . '/../../views/config/sessionAuth.php';
require_once '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$client = new Google_Client();
$client->setClientId($_ENV['GOOGLE_CLIENT_ID']); 
$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']); 
$client->setRedirectUri($path . 'controllers/callbacks/callback.php');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    $oauth2 = new Google_Service_Oauth2($client);
    $userInfo = $oauth2->userinfo->get();

    // Extraire les informations utilisateur
    $email = $userInfo->email;
    $nom = $userInfo->familyName;
    $prenom = $userInfo->givenName;
    $roleID = 4;
    $active = 0;
    $token = generateToken();
    $provider = "Google";

    // Vérifie si l'utilisateur existe
    $stmt = $PDO->prepare('SELECT
            users.id AS user_id, 
            users.provider,
            users.prenom, 
            users.nom, 
            users.mail, 
            users.password, 
            users.token,
            users.active,
            roles.id AS role_id,
            roles.name,
            roles.slug,
            roles.level
        FROM 
            users 
        LEFT JOIN 
            roles 
        ON 
            users.role_id = roles.id 
        WHERE 
            mail = :mail');
    $stmt->execute(['mail' => $email]);
    $user = $stmt->fetch();

    if (!$user) {
        // Si l'utilisateur n'existe pas, l'insérer dans la base de données
        $stmt = $PDO->prepare('INSERT INTO users (nom, prenom, mail, role_id, active, token, provider) VALUES (:nom, :prenom, :email, :role_id, :active, :token, :provider)');
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':role_id', $roleID, PDO::PARAM_INT);
        $stmt->bindParam(':active', $active, PDO::PARAM_INT);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->bindParam(':provider', $provider, PDO::PARAM_STR);

        if ($stmt->execute()) {
            sendVerificationEmail($email, $prenom, $token);
        } else {
            die("Erreur : Impossible de créer l'utilisateur.");
        }
    }

    // Vérifie si l'utilisateur est actif
    if ($user && $user->active == 1) {
        $_SESSION['token'] = $user->token;
        $_SESSION['Auth'] = $user;

        // Redirige vers l'application
        header('Location:' . $path.'index.php');
        exit;
    } else {
        // Message pour compte inactif
        header('Location:' . $path . 'message.php');
        exit;
    }
}

/**
 * Envoie un email de vérification avec PHPMailer.
 */
function sendVerificationEmail($email, $prenom, $token)
{
    global $path;
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_SMTP'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_NOREPLY'];
        $mail->Password = $_ENV['MDP_NOREPLY'];
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';

        $mail->setFrom($_ENV['MAIL_NOREPLY'], 'noreply.buddizsport');
        $mail->addAddress($email, $prenom);

        $mail->isHTML(true);
        $mail->Subject = 'Vérification de votre compte';
        $mail->Body = 'Bonjour ' . $prenom . ',<br><br>Cliquez sur ce lien pour vérifier votre compte : <a href="' . $path . 'verify.php?token=' . $token . '">Vérifier mon compte</a><br><br>Merci !';
        $mail->AltBody = 'Bonjour ' . $prenom . ',\n\nCliquez sur ce lien pour vérifier votre compte : ' . $path . 'verify.php?token=' . $token . '\n\nMerci !';

        $mail->send();
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi de l'email : {$mail->ErrorInfo}";
    }
}