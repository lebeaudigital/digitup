<?php
require_once __DIR__.'/../../views/config/sessionAuth.php';


$data = json_decode(file_get_contents("php://input"), true);

// Debugging : Vérifier les données reçues
file_put_contents("log.txt", print_r($data, true), FILE_APPEND);

$user_id = $data['user_id'] ?? 0;
$scorm_id = $data['scorm_id'] ?? '';  // Correction ici
$lesson_status = !empty($data['lesson_status']) ? $data['lesson_status'] : 'not attempted';
$score = $data['score'] ?? 0;
$session_time = $data['session_time'] ?? '00:00:00';

if ($user_id && $scorm_id) {  // Correction ici
    $stmt = $PDO->prepare("INSERT INTO scorm_tracking (user_id, scorm_id, lesson_status, score, session_time, date_updated) 
                           VALUES (:user_id, :scorm_id, :lesson_status, :score, :session_time, NOW())
                           ON DUPLICATE KEY UPDATE lesson_status = :lesson_status, score = :score, session_time = :session_time, date_updated = NOW()");

    $success = $stmt->execute([
        'user_id' => $user_id,
        'scorm_id' => $scorm_id,  // Correction ici
        'lesson_status' => $lesson_status,
        'score' => $score,
        'session_time' => $session_time
    ]);

    if ($success) {
        echo json_encode(["success" => true, "message" => "Progression sauvegardée"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erreur SQL", "error" => $stmt->errorInfo()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Données incomplètes"]);
}
?>