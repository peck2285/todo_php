<?php
session_start();
include 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Ma Todo List</h1>

    <!-- Formulaire pour ajouter une nouvelle tâche -->
    <form action="ajouter_tache.php" method="post">
        <label for="titre">Titre de la tâche:</label>
        <input type="text" id="titre" name="titre" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        
        <button type="submit">Ajouter la tâche</button>
    </form>

    <!-- Section pour afficher la liste des tâches -->
    <section>
        <h2>Liste des Tâches</h2>
        <ul>
        <?php
        // Placeholder pour la liste des tâches (à remplacer par une connexion à une base de données)
        $taches = isset($_SESSION['taches']) ? $_SESSION['taches'] : array();

        foreach ($taches as $tache) {
            echo "<li>{$tache['titre']} - {$tache['description']} ";

            // Ajouter des boutons pour marquer comme terminé ou en cours
            echo "<form action='modifier_tache.php' method='post' style='display:inline;'>";
            echo "<input type='hidden' name='tache_id' value='{$tache['id']}'>";
            echo "<button type='submit' name='action' value='terminer'>Terminer</button>";
            echo "<button type='submit' name='action' value='en_cours'>En cours</button>";
            echo "</form>";

            // Bouton pour supprimer la tâche
            echo "<form action='supprimer_tache.php' method='post' class='inline'>";
            echo "<input type='hidden' name='tache_id' value='{$tache['id']}'>";
            echo "<button type='submit' name='action' value='supprimer'>Supprimer</button>";
            echo "</form>";

            echo "</li>";
        }
        ?>
        </ul>
    </section>

</body>
</html>
