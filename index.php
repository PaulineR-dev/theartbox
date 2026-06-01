<?php
    require 'header.php';
    include 'bdd.php';

    $cobdd = connexion();
    
    $donneesoeuvres = $cobdd->prepare('SELECT * FROM oeuvres');
    $donneesoeuvres->execute();

    $oeuvres = $donneesoeuvres->fetchAll();
?>

<?php if (isset($_GET['formulaireenvoye'])): ?>
    <p>Le formulaire a bien été envoyé.</p>
<?php endif; ?>

<div id="liste-oeuvres">
    <?php foreach($oeuvres as $oeuvre): ?>
        <article class="oeuvre">
            <a href="oeuvre.php?id=<?= $oeuvre['id'] ?>">
                <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
                <h2><?= $oeuvre['titre'] ?></h2>
                <p class="description"><?= $oeuvre['artiste'] ?></p>
            </a>
        </article>
    <?php endforeach; ?>
</div>
<?php require 'footer.php'; ?>