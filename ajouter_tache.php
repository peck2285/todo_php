<?php
require_once('functions.php');
session_start();

// Fonction de validation pour nettoyer les données

function valider_donnees( $donnees ) {
    $donnees = trim( $donnees );
    $donnees = stripslashes( $donnees );
    $donnees = htmlspecialchars( $donnees );
    return $donnees;
}

// Vérifier si le formulaire a été soumis
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
    // Récupérer et valider les données du formulaire
    $titre = valider_donnees( $_POST[ 'titre' ] );
    $description = valider_donnees( $_POST[ 'description' ] );

    // Vérifier si le tableau de tâches existe, sinon le créer
    if ( !isset( $_SESSION[ 'taches' ] ) ) {
        $_SESSION[ 'taches' ] = array();
    }

    // Ajouter la nouvelle tâche au tableau
    $nouvelleTache = array(
        'id' => count( $_SESSION[ 'taches' ] ) + 1,
        'titre' => $titre,
        'description' => $description
    );

    // Ajouter la tâche à la session
    $_SESSION[ 'taches' ][] = $nouvelleTache;

    // Sauvegarder la tâche en base de données
    sauvegarder_taches( array( $nouvelleTache ) );
    // Vous pouvez ajuster la fonction pour traiter un tableau de tâches

    // Rediriger vers la page principale
    header( 'Location: index.php' );
    exit();
}
?>
