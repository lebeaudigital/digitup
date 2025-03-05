export function scormProgress(){
    document.addEventListener("DOMContentLoaded", function () {
        pipwerks.SCORM.init();
        updateProgress(); // Met à jour la barre au chargement
        setInterval(updateProgress, 2000);
    });
    
    const getIDs = document.getElementById("getIDs");
    const userId = getIDs.dataset.user_id;
    const scormId = getIDs.dataset.scorm_id;
    
    console.log(userId, scormId);
    
    function saveProgress() {
        let lessonStatus = pipwerks.SCORM.get("cmi.core.lesson_status") || pipwerks.SCORM.get("cmi.completion_status");
        console.log("🎯 SCORM Lesson Status:", lessonStatus);
        let score = pipwerks.SCORM.get("cmi.core.score.raw");
        let sessionTime = pipwerks.SCORM.get("cmi.core.session_time");
    
    
        fetch("AJAX/save_progress.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                user_id: userId,
                scorm_id: scormId,
                lesson_status: lessonStatus,
                score: score,
                session_time: sessionTime
            })
        })
        .then(response => response.json())
        .then(data => console.log("✅ Réponse du serveur :", data))
        .catch(error => console.error("❌ Erreur AJAX :", error));
    }
    
    window.onbeforeunload = function () {
        saveProgress();
        pipwerks.SCORM.quit();
    };
    
    function updateProgress() {
        let score = pipwerks.SCORM.get("cmi.core.score.raw") || 0; // Récupère le score (par défaut 0)
        console.log("📊 Score SCORM:", score);
    
        let progressBar = document.getElementById("scormProgressBar");
        progressBar.style.width = score + "%";  // Ajuste la largeur
    }
}