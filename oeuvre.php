<?php
    require 'header.php';

    include 'bdd.php'; // Appel fichier de connexion à la bdd
    $cobdd = connexion ();

    // Si l'URL ne contient pas d'id, on redirige sur la page d'accueil
    if(empty($_GET['id'])) {
        header('Location: index.php');
    }

    $uneOeuvreDonnees = $cobdd->prepare('SELECT * FROM oeuvres WHERE id = :id');
    $uneOeuvreDonnees->execute(['id' => $_GET['id']]);
    $oeuvre = $uneOeuvreDonnees->fetch();

    if (!$oeuvre) { // Si pas d'oeuvre qui correspond, pas d'id existante, alors redirection
        header('Location: index.php');
    exit;
    }
?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['titre'] ?></h1>
        <p class="description"><?= $oeuvre['artiste'] ?></p>
        <p class="description-complete">
             <?= $oeuvre['description'] ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>
