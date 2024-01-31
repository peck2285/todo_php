<?php
session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $tache_id = $_POST["tache_id"];

    // Rechercher la tâche dans le tableau et la supprimer
    foreach ($_SESSION['taches'] as $key => $tache) {
        if ($tache['id'] == $tache_id) {
            unset($_SESSION['taches'][$key]);
            break;
        }
    }
}

// Rediriger vers la page principale
header("Location: index.php");
exit();
?>
