<?php
include "db.php";
    
$db = connexionBase();
$requete = $db->query("SELECT * FROM disc JOIN artist ON disc.artist_id = artist.artist_id");

$myDisc = $requete->fetchAll(PDO::FETCH_OBJ);

$requete->closeCursor();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Liste des disques</title>
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-between pt-5 pb-5">
        <div>
            <h1>
            Liste des disques(<?=count($myDisc) ?>)
            </h1>
        </div>
            <div>
                <a class="btn btn-primary" href="disc_new.php">Ajouter</a>
            </div>
        </div>
        <div class="row d-flex justify-content-between">
         <?php foreach ($myDisc as $disc): ?>
            <div class="row col-6 bg-light rounded">
            <div class="col my-3">
            <img src="jaquettes/<?= $disc->disc_picture ?>" width="300px" height="300px" alt="Jaquette">
            </div>
            <div class="col my-3">
            <div><b><h3><?= $disc->disc_title ?></h3></b></div>
            <div><b><?= $disc->artist_name ?></b></div>
            <div><b>Label : </b><?= $disc->disc_label ?></div>
            <div><b>Année : </b><?= $disc->disc_year ?></div>
            <div><b>Genre : </b><?= $disc->disc_genre ?></div>
            <div><a class="btn btn-primary" href="disc_detail.php?id=<?= $disc->disc_id ?>">Détails</a></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>