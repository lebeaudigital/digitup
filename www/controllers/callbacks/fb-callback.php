<?php
require_once __DIR__.'/../views/config/sessionAuth.php';

// Configuration Facebook
$client_id = $_ENV['FB_CLIENT_ID'];
$client_secret = $_ENV['FB_CLIENT_SECRET'];
$redirect_uri = $path.'controllers/callbacks/fb-callback.php';

// Récupérer le code d'autorisation de Facebook
if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // Échanger le code contre un jeton d'accès
    $token_url = "https://graph.facebook.com/v12.0/oauth/access_token?client_id=$client_id&redirect_uri=$redirect_uri&client_secret=$client_secret&code=$code";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $token_response = curl_exec($ch);
    curl_close($ch);

    // Décoder la réponse pour obtenir le jeton d'accès
    $token_data = json_decode($token_response, true);

    if (isset($token_data['access_token'])) {
        $access_token = $token_data['access_token'];

        // Utiliser le jeton pour obtenir des informations utilisateur
        $graph_url = "https://graph.facebook.com/me?fields=id,first_name,last_name,email&access_token=$access_token";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $graph_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $user_response = curl_exec($ch);
        curl_close($ch);

        // Décoder la réponse JSON pour obtenir les informations utilisateur
        $user_data = json_decode($user_response, true);

        if (isset($user_data['email'])) {
            $email = $user_data['email'];
            $prenom = $user_data['first_name'];
            $nom = $user_data['last_name'];
            $token = generateToken(); // Utiliser une fonction pour générer un token sécurisé

            // Vérifier si l'utilisateur existe déjà dans la base de données
            $stmt = $pdo->prepare('SELECT * FROM users WHERE mail = :email');
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if (!$user) {
                // Insérer un nouvel utilisateur dans la base de données
                $stmt = $pdo->prepare('INSERT INTO users (nom, prenom, mail, from_site, role_id, active, token, entreprise_id, provider) VALUES (:nom, :prenom, :email, :from_site, :role_id, :active, :token, :entreprise_id, :provider)');
                $stmt->execute([
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'email' => $email,
                    'from_site' => $website,
                    'role_id' => 3, // Role par défaut, peut être adapté selon tes besoins (3 = member)
                    'active' => 1, // Activer l'utilisateur par défaut
                    'token' => $token,
                    'provider' => 'Facebook',
                ]);

                // Récupérer à nouveau l'utilisateur pour l'ajouter dans la session
                $stmt = $pdo->prepare('SELECT * FROM users WHERE mail = :email');
                $stmt->execute(['email' => $email]);
                $user = $stmt->fetch();
            }

            // Initialiser la session utilisateur
            if ($user) {
                $_SESSION['token'] = $user->token;
                $_SESSION['Auth'] = $user;

                // Rediriger vers la page d'accueil ou une autre page après la connexion
                header('Location:'.$path);
                exit;
            }
        } else {
            echo 'Erreur : Impossible de récupérer l\'adresse e-mail.';
        }
    } else {
        echo 'Erreur : Impossible de récupérer le jeton d\'accès.';
    }
} else {
    echo 'Erreur : Pas de code de retour de Facebook.';
}