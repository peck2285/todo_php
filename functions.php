<?php

function getConnexion() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mudey_todo";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo "Erreur de connexion à la base de données: " . $e->getMessage();
        return null;
    }   
}

function sauvegarder_taches($taches) {
    $conn = getConnexion();
    if ($conn) {
        foreach ($taches as $tache) {
            $stmt = $conn->prepare("INSERT INTO taches (titre, description, etat) VALUES (:titre, :description, :etat)");
            $stmt->bindParam(':titre', $tache['titre']);
            $stmt->bindParam(':description', $tache['description']);
            $stmt->bindParam(':etat', $tache['etat']);
            $stmt->execute();
        }
        $conn = null;
    }
}

function charger_taches() {
    $conn = getConnexion();
    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM taches");
        $stmt->execute();
        $taches = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        return $taches;
    }
    return array();
}

?>
