<?php
$roles = [];

class Auth {
    
    var $forbiddenPage = "forbidden.php";
    var $erreur = "";
    
    /**
     * Permet d'identifier un utilisateur
     **/
    function login($d, $isGoogleLogin = false) {
        global $PDO;

        $sql = 
        "SELECT
            users.id AS user_id, 
            users.from_site,
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
            mail = :mail 
        AND 
            from_site = :from_site
        ";
        
        $req = $PDO->prepare($sql);
        $req->bindParam(':mail', $d['mail'], PDO::PARAM_STR);
        $req->bindParam(':from_site', $d['from_site'], PDO::PARAM_STR);
        $req->execute();
        $user = $req->fetch(PDO::FETCH_OBJ);
        
        if ($user) {
            // Vérifier si l'utilisateur est inactif
            if ($user->active == 0) {
                $this->erreur = 'Votre compte est inactif. Veuillez vérifier vos emails pour activer votre compte.';
                return false;
            }

            // Cas de la connexion via Google (pas de vérification de mot de passe)
            if ($isGoogleLogin) {
                $this->updateSessionAndToken($user);
                return true;
            }

            // Cas de la connexion classique (vérification du mot de passe)
            if (password_verify($d['password'], $user->password)) {
                return $this->updateSessionAndToken($user);
            } else {
                $this->erreur = 'Votre identifiant ou mot de passe n\'est pas correct!';
                return false;
            }
        }
        
        $this->erreur = 'Utilisateur non trouvé!';
        return false; 
    }

    /**
     * Met à jour le token et la session pour un utilisateur
     **/
    private function updateSessionAndToken($user) {
        global $PDO;

        $newToken = generateToken();
        $sql = "UPDATE users SET token = :token WHERE id = :id";
        $stmt = $PDO->prepare($sql);
        $stmt->bindParam(':token', $newToken, PDO::PARAM_STR);
        $stmt->bindParam(':id', $user->user_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['token'] = $newToken;
            $_SESSION['Auth'] = $user;
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "Erreur d'exécution de la requête: " . $errorInfo[2];
            return false;
        }
    }
    
    /**
     * Autorise un rang à accéder à une page, redirige vers forbidden sinon
     **/
    function allow($rang) {
        global $PDO; 
        $req = $PDO->prepare('SELECT * FROM roles');
        $req->execute();
        $data = $req->fetchAll();
        foreach ($data as $d) {
            @$roles[$d->slug] = $d->level;
        }
        if (!$this->user('slug')) {
            $this->forbidden();
        } else {
            return true;
        }
    }
    
    /**
     * Récupère une info utilisateur
     **/
    function user($field) {
        if ($field == 'role') $field = 'slug'; 
        if (isset($_SESSION['Auth']->$field)) {
            return $_SESSION['Auth']->$field;
        } else {
            return false; 
        }
    }
    
    /**
     * Redirige un utilisateur
     **/
    function forbidden() {
        header('Location:../' . $this->forbiddenPage);
    }
}

$Auth = new Auth();