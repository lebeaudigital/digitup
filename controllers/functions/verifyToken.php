<?php
function verifyToken($PDO) {
    if (!isset($_SESSION['token'])) {
        return false;
    }

    $token = $_SESSION['token'];
    $query = "SELECT * FROM users WHERE token = :token";
    $stmt = $PDO->prepare($query);
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->rowCount() > 0;
}
