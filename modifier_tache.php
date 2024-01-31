<?php
session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $tache_id = $_POST["tache_id"];
    $action = $_POST["action"];

    // Rechercher la tâche dans le tableau
    foreach ($_SESSION['taches'] as &$tache) {
        if ($tache['id'] == $tache_id) {
            // Modifier l'état de la tâche en fonction de l'action
            if ($action == 'terminer') {
                $tache['etat'] = 'terminee';
            } elseif ($action == 'en_cours') {
                $tache['etat'] = 'en_cours';
            }
            break;
        }
    }
}

// Rediriger vers la page principale
header("Location: index.php");
exit();
?>
