<?php
    $formulaireDonnees = $_POST;

    // Vérification des données
    if (
        empty($formulaireDonnees['titre']) ||
        empty($formulaireDonnees['artiste']) ||
        mb_strlen($formulaireDonnees['description']) < 3 ||
        !filter_var($formulaireDonnees['image'], FILTER_VALIDATE_URL) 
        // || strpos($formulaireDonnees['image'], 'https://') !== 0
    ) {
        header('Location: ajouter.php?erreur');
        exit;
    }

    $titre = htmlspecialchars($formulaireDonnees['titre']);
    $artiste = htmlspecialchars($formulaireDonnees['artiste']);
    $description = strip_tags($formulaireDonnees['description']);
    $image = htmlspecialchars($formulaireDonnees['image']);

    include 'bdd.php';
    $cobdd = connexion();

    $sqlQuery = 'INSERT INTO oeuvres (titre, artiste, description, image)
             VALUES (:titre, :artiste, :description, :image)';

    $insertOeuvre = $cobdd->prepare($sqlQuery);
    $insertOeuvre->execute([
        'titre' => $titre,
        'artiste' => $artiste,
        'description' => $description,
        'image' => $image
    ]);

    header('Location: index.php?formulaireenvoye');
    exit;